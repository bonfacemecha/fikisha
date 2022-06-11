@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h5>At a Glance</h5>
            </div>
            <div class="col-sm-6">
                <div class="d-flex justify-content-end">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xs-6 col-xl-3">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Pending</div>
                                <div class="widget-subheading">Orders pending processing</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-success">{{ $count_pending_orders }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-6 col-xl-3">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper justify-content-between d-flex">
                            <div class="widget-content-left">
                                <div class="widget-heading">Loading</div>
                                <div class="widget-subheading">Orders being loaded</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning">{{ $count_loading_orders }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-6 col-xl-3">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Dispatched</div>
                                <div class="widget-subheading">Orders Dispatched</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-danger">{{ $count_dispatched_orders }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-6 col-xl-3">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Delivered</div>
                                <div class="widget-subheading">Orders deliverd</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-danger">{{ $count_delivered_orders }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="d-flex justify-content-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        View Fleet Summary
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Fleet Summary at Glance</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-6 col-xs-6 col-xl-4">
                                            <div class="card mb-3 widget-content">
                                                <div class="widget-content-outer">
                                                    <div class="widget-content-wrapper justify-content-between d-flex">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Available</div>
                                                            <div class="widget-subheading">Available vehicles</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-warning">
                                                                {{ $count_available_vehicles }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6 col-xl-4">
                                            <div class="card mb-3 widget-content">
                                                <div class="widget-content-outer">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Loading</div>
                                                            <div class="widget-subheading">Loading vehicles</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-danger">
                                                                {{ $count_loading_vehicles }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-6 col-xl-4">
                                            <div class="card mb-3 widget-content">
                                                <div class="widget-content-outer">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">On Transit</div>
                                                            <div class="widget-subheading">Vehicles on transit</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="widget-numbers text-danger">
                                                                {{ $count_on_transit_vehicles }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <order-component></order-component>
@endsection
