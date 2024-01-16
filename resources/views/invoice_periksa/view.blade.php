<a href="#" data-bs-toggle="modal" data-bs-target="#view"
                            class="me-2 btn icon icon-left btn-primary float-end"><i class="fas fa-calendar"></i>
                            View</a>
                        <form action="" method="get">
                            <div class="modal fade text-left" id="view">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">
                                                Edit Dokter dan Pembayaran
                                            </h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control" name="tgl1" value="{{ date('Y-m-d') }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control" name="tgl2" value="{{ date('Y-m-t') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Save</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>