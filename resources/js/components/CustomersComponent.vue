<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="row">
        <div class="col-sm-6">
          <h3>Customer Management</h3>
        </div>
        <div class="col-sm-6">
          <div class="d-flex justify-content-end">
            <button
              class="btn btn-danger"
              data-toggle="modal"
              data-target="#addNew"
              @click="openModalWindow"
            >
              Add Customer
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-plus-circle-fill"
                viewBox="0 0 16 16"
              >
                <path
                  d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"
                />
              </svg>
            </button>
            <div>
              <div
                class="modal fade"
                id="addNew"
                tabindex="-1"
                role="dialog"
                aria-labelledby="addNewLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5
                        v-show="!editMode && !viewMode"
                        class="modal-title"
                        id="addNewLabel"
                      >Add New Customer</h5>
                      <h5 v-show="editMode" class="modal-title" id="addNewLabel">Update Customer</h5>
                      <h5 v-show="viewMode" class="modal-title" id="addNewLabel">Customer Details</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <form action v-if="viewMode == true">
                      <div class="modal-body">
                        <table class="table">
                          <tbody>
                            <tr>
                              <th scope="row">Name:</th>
                              <td>{{form.name}}</td>
                            </tr>
                            <tr>
                              <th scope="row">Email:</th>
                              <td>{{form.email}}</td>
                            </tr>
                            <tr>
                              <th scope="row">Phone Number:</th>
                              <td>{{form.phone_number}}</td>
                            </tr>
                            <tr>
                              <th scope="row">ID:</th>
                              <td>{{form.id_number}}</td>
                            </tr>
                            <tr>
                              <th scope="row">KRA NO.:</th>
                              <td>{{form.kra_pin}}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </form>
                    <form @submit.prevent="editMode ? updateCustomer() : createCustomer()" v-else>
                      <div class="modal-body">
                        <div class="form-group mb-1">
                          <label for="name">Name</label>
                          <input
                            v-model="form.name"
                            type="text"
                            name="name"
                            placeholder="Name"
                            class="form-control"
                          />
                          <div
                            class="text-danger"
                            v-if="form.errors.has('name')"
                            v-html="form.errors.get('name')"
                          />
                        </div>
                        <div class="form-group mb-1">
                          <label for="email">Email</label>
                          <input
                            v-model="form.email"
                            type="email"
                            name="email"
                            placeholder="Email Address"
                            class="form-control"
                          />
                          <div
                            class="text-danger"
                            v-if="form.errors.has('email')"
                            v-html="form.errors.get('email')"
                          />
                        </div>
                        <div class="form-group mb-1">
                          <label for="email">Phone number</label>
                          <input
                            v-model="form.phone_number"
                            type="number"
                            name="phone_number"
                            placeholder="Phone number"
                            class="form-control"
                          />
                          <div
                            class="text-danger"
                            v-if="form.errors.has('phone_number')"
                            v-html="form.errors.get('phone_number')"
                          />
                        </div>
                        <div class="form-group mb-1">
                          <label for="email">Kra pin</label>
                          <input
                            v-model="form.kra_pin"
                            type="text"
                            name="Kra pin"
                            placeholder="A123456789P"
                            class="form-control"
                          />
                          <div
                            class="text-danger"
                            v-if="form.errors.has('kra_pin')"
                            v-html="form.errors.get('kra_pin')"
                          />
                        </div>
                        <div class="form-group mb-1">
                          <label for="email">ID number</label>
                          <input
                            v-model="form.id_number"
                            type="number"
                            name="id_number"
                            placeholder="12345678"
                            class="form-control"
                          />
                          <div
                            class="text-danger"
                            v-if="form.errors.has('id_number')"
                            v-html="form.errors.get('id_number')"
                          />
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                        <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="row mt-4">
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
            <div class="col-sm-12">
              <div class="card bg-white">
                <div class="card-body">
                  <div class="table-responsivex">
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
                      :items="customers"
                      :fields="customerColumns"
                      caption-top
                    >
                      <template #cell(status)="row">
                        <b-button
                          v-if="row.item.status == 'active'"
                          variant="success"
                          class="text-capitalize"
                          size="sm"
                        >{{row.item.status}}</b-button>
                        <b-button
                          v-else-if="row.item.status == 'inactive'"
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
                        <b-dropdown
                          id="dropdown-offset"
                          offset="25"
                          text="Offset Dropdown"
                          toggle-class="notbtn text-decoration-none"
                          no-caret
                        >
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
                          <b-dropdown-item
                            data-id="customer.id"
                            @click="viewModalWindow(row.item)"
                          >View/Read</b-dropdown-item>
                          <b-dropdown-item
                            data-id="customer.id"
                            @click="editModalWindow(row.item)"
                          >Edit</b-dropdown-item>
                          <b-dropdown-item
                            @click="handleDelete(row.item, row.index, $event.target)"
                          >Delete</b-dropdown-item>
                        </b-dropdown>
                      </template>
                    </b-table>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="dataTables_paginate paging_simple_numbers float-right">
                        <ul class="pagination pagination-rounded mb-0">
                          <!-- pagination -->
                          <b-pagination
                            v-model="currentPage"
                            :total-rows="totalRows"
                            :per-page="perPage"
                            prev-text="Prev"
                            next-text="Next"
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
      </div>
    </div>
  </div>
</template>

<script>
import { FormSelectPlugin } from "bootstrap-vue";
Vue.use(FormSelectPlugin);
import Form from "vform";

export default {
  props: ["activecustomer"],
  data() {
    return {
      customers: [],
      editMode: false,
      viewMode: false,
      form: new Form({
        id: "",
        name: "",
        email: "",
        kra_pin: "",
        id_number: "",
        phone_number: ""
      }),
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      noResults: false,
      filter: null,
      filterOn: [],
      currentPage: 1,
      sortBy: "name",
      sortDesc: false,
      searching: false,
      customerColumns: [
        {
          key: "name",
          label: "Name"
        },
        {
          key: "email",
          label: "Email"
        },
        {
          key: "kra_pin"
        },
        {
          key: "id_number",
          label: "ID Number"
        },
        {
          key: "status",
          label: "Status"
        },
        {
          key: "action",
          label: "Action"
        }
      ],
      isLoading: false,
      fullPage: true
    };
  },
  mounted() {
    this.getCustomers();
  },
  methods: {
    initialiseSlides(e) {
      e.preventDefault();
    },
    openModalWindow() {
      this.editMode = false;
      this.viewMode = false;

      this.form.reset();
      $("#addNew").modal("show");
    },
    editModalWindow(customer) {
      this.form.clear();
      this.editMode = true;
      this.viewMode = false;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(customer);
    },
    viewModalWindow(customer) {
      this.form.clear();
      this.editMode = false;
      this.viewMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(customer);
    },
    getCustomers() {
      axios.get("customers/list").then(response => {
        this.customers = response.data;
      });
    },
    handleDelete(row, index, item, event) {
      Swal.fire({
        title: "Are you sure,",
        html: `<p class="copy-small">You want to delete <span class="text-danger"> ${row.name}</span>? </p>`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete!"
      }).then(result => {
        if (result.value) {
          this.axios
            .post(`/customer/delete/${row.id}`)
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
    },
    updateCustomer() {
      this.form
        .put("/customer/update/" + this.form.id)
        .then(() => {
          Toast.fire({
            icon: "success",
            title: "Customer updated successfully"
          });

          window.location.reload();

          $("#addNew").modal("hide");
        })
        .catch(() => {
          console.log("Error.....");
        });
    },
    createCustomer() {
      this.form
        .post("customer/store")
        .then(() => {
          Toast.fire({
            icon: "success",
            title: "Customer created successfully"
          });

          window.location.reload();

          $("#addNew").modal("hide");
        })
        .catch(() => {
          console.log("Error......");
        });
    },
    /**
     * Search the table data with search input
     */
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    }
  },
  computed: {
    totalRows() {
      return this.customers.length;
    }
  },
  components: {}
};
</script>
<style scoped></style>
