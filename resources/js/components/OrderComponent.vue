<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h4>Orders</h4>
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 py-3 col-md-6">
                <div id="tickets-table_length" class="dataTables_length">
                  <label class="d-inline-flex">
                    Show&nbsp;&nbsp;
                    <b-form-select v-model="perPage" size="sm" :options="pageOptions"></b-form-select>&nbsp;entries
                  </label>
                </div>
              </div>
              <!-- Search -->
              <div class="col-sm-12 py-3 col-md-6">
                <div
                  id="tickets-table_filter"
                  class="dataTables_filter text-md-right d-flex justify-content-end"
                >
                  <label class="d-inline-flex">
                    Search:&nbsp;&nbsp;
                    <b-form-input
                      type="search"
                      v-model="filter"
                      placeholder="Search..."
                      class="form-control form-control-sm"
                    ></b-form-input>
                  </label>
                </div>
              </div>
            </div>

            <b-table
              hover
              responsive="sm"
              :per-page="perPage"
              :current-page="currentPage"
              :sort-by.sync="sortBy"
              :sort-desc.sync="sortDesc"
              :filter="filter"
              :filter-included-fields="filterOn"
              @filtered="onFiltered"
              :items="orders"
              :fields="orderColumns"
              caption-top
            >
              <template #cell(status)="row">
                <b-button
                  v-if="row.item.status == 'dispatched'"
                  variant="success"
                  class="text-capitalize"
                  size="sm"
                >{{row.item.status}}</b-button>
                <b-button
                  v-else-if="row.item.status == 'pending'"
                  variant="info"
                  class="text-capitalize"
                  size="sm"
                >{{row.item.status}}</b-button>
                <b-button
                  v-else
                  variant="danger"
                  class="text-capitalize"
                  size="sm"
                >{{row.item.status}}</b-button>
              </template>
              <template #cell(action)="row">
                <b-dropdown toggle-class="notbtn btn-default text-decoration-none" right no-caret>
                  <template v-slot:button-content>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather fill-current dark-gray feather-more-vertical"
                    >
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="12" cy="5" r="1" />
                      <circle cx="12" cy="19" r="1" />
                    </svg>
                  </template>
                  <b-dropdown-item @click="handleStatus(row.item, 'loading')">Loading</b-dropdown-item>
                  <b-dropdown-item @click="handleStatus(row.item, 'dispatched')">Dispatched</b-dropdown-item>
                  <b-dropdown-item @click="handleStatus(row.item, 'delivered')">Delivered</b-dropdown-item>
                </b-dropdown>
              </template>
            </b-table>
            <div class="row">
              <div class="col">
                <div class="dataTables_paginate paging_simple_numbers float-right">
                  <ul class="pagination pagination-rounded mb-0">
                    <!-- pagination -->
                    <b-pagination
                      v-model="currentPage"
                      :total-rows="totalRows"
                      :per-page="perPage"
                      align="fill"
                      size="md"
                      class="my-0"
                    ></b-pagination>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "OrderComponent",
  data() {
    return {
      name: "",
      description: "",
      nameState: null,
      orders: [],
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      noResults: false,
      filter: null,
      filterOn: [],
      currentPage: 1,
      sortBy: "name",
      sortDesc: false,
      searching: false,
      orderColumns: [
        {
          key: "order_number"
        },
        {
          key: "destination"
        },
        {
          key: "vehicle.veh_reg_number",
          label: "Assigned Vehicle"
        },
        {
          key: "customer.name",
          label: "Customer"
        },
        {
          key: "status",
          label: "Status"
        },
        {
          key: "action",
          label: "Action"
        }
      ]
    };
  },
  mounted() {
    this.getOrders();
  },
  methods: {
    initialiseSlides(e) {
      e.preventDefault();
    },
    getOrders() {
      axios.get("/orders/list").then(response => {
        this.orders = response.data;
      });
    },
    /**
     * Search the table data with search input
     */
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    handleStatus(row, status) {
      Swal.fire({
        title: "Are you sure,",
        html: `<p class="copy-small">You want to action <strong>${row.order_number}</strong> to <span class="text-danger text-capitalize"> ${status}</span>? </p>`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Action!"
      }).then(result => {
        if (result.value) {
          let payload = {
            status: status
          };
          this.axios
            .post(`/changes/status/order/${row.id}`, payload)
            .then(response => {
              Toast.fire({
                icon: "success",
                title: response.data.message
              });
              window.location.reload();
            })
            .catch(() => {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
                footer: "<a href>Why do I have this issue?</a>"
              });
              window.location.reload();
            });
        }
      });
    }
  },
  computed: {
    totalRows() {
      return this.orders.length;
    }
  }
};
</script>
