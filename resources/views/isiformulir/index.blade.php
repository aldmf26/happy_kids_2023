@extends('theme.app')
@section('content')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>{{ $title }}</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <input type="hidden" id="hal" class="hal" value="{{ $hal }}">
            <section class="section">
                <div id="multi-step-form-container">
                    <!-- Form Steps / Progress Bar -->
                    <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                        <!-- Step 1 -->
                        <li class="form-stepper-active form-stepper-unfinished1 text-center form-stepper-list"
                            step="1">
                            <a class="mx-2">
                                <span class="form-stepper-circle">
                                    <span>1</span>
                                </span>
                                <div class="label">Psikomotorik </div>
                            </a>
                        </li>
                        <!-- Step 2 -->
                        <li class="form-stepper-unfinished form-stepper-unfinished2  text-center form-stepper-list"
                            step="2">
                            <a class="mx-2">
                                <span class="form-stepper-circle text-muted">
                                    <span>2</span>
                                </span>
                                <div class="label text-muted">KPSP Pada Anak</div>
                            </a>
                        </li>
                        <!-- Step 3 -->
                        <li class="form-stepper-unfinished form-stepper-unfinished3 text-center form-stepper-list"
                            step="3">
                            <a class="mx-2">
                                <span class="form-stepper-circle text-muted">
                                    <span>3</span>
                                </span>
                                <div class="label text-muted">PEDS</div>
                            </a>
                        </li>
                        <li class="form-stepper-unfinished form-stepper-unfinished4 text-center form-stepper-list"
                            step="4">
                            <a class="mx-2">
                                <span class="form-stepper-circle text-muted">
                                    <span>4</span>
                                </span>
                                <div class="label text-muted">M-Chat-R</div>
                            </a>
                        </li>
                    </ul>
                    <input type="hidden" value="{{ $no_order }}" id="no_order">
                    <input type="hidden" value="{{ $member_id }}" id="member_id">

                    <!-- Step 1 Content -->
                    <section id="step-1" class="form-step">

                    </section>
                    <!-- Step 2 Content, default hidden on page load. -->
                    <section id="step-2" class="form-step d-none">

                    </section>
                    <section id="step-3" class="form-step d-none">

                    </section>
                    <input type="hidden" class="next" value="1">
                    <section id="step-4" class="form-step d-none">

                    </section>

                    <!-- Step 3 Content, default hidden on page load. -->

                </div>
            </section>
        </div>

    </div>
@endsection
@section('scripts')
    <script script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            load_form1();

            function load_form1(hal) {
                if (hal == undefined) {
                    var page = $('.hal').val();
                } else {
                    var page = hal;

                }

                var no_order = $("#no_order").val();
                var member_id = $("#member_id").val();

                if (page == '1') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('form1') }}?",
                        data: {
                            no_order: no_order,
                            member_id: member_id,
                        },
                        dataType: "html",
                        success: function(hasil) {
                            $('#step-1').html(hasil);
                        }
                    });

                } else if (page == '2') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('form2') }}",
                        data: {
                            no_order: no_order,
                            member_id: member_id,
                        },
                        dataType: "html",
                        success: function(hasil) {
                            $('#step-2').html(hasil);
                            $("#step-1").addClass("d-none");
                            $(".form-stepper-unfinished1").addClass(
                                "form-stepper-completed");

                            $("#step-2").removeClass("d-none");
                            $(".form-stepper-unfinished2").addClass(
                                "form-stepper-active");
                        }
                    });
                } else if (page == '3') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('form3') }}",
                        data: {
                            no_order: no_order,
                            member_id: member_id,
                        },
                        dataType: "html",
                        success: function(hasil) {
                            $('#step-3').html(hasil);
                            $("#step-1").addClass("d-none");
                            $(".form-stepper-unfinished1").addClass(
                                "form-stepper-completed");
                            $("#step-2").addClass("d-none");
                            $(".form-stepper-unfinished2").addClass(
                                "form-stepper-completed");

                            $("#step-3").removeClass("d-none");
                            $(".form-stepper-unfinished3").addClass(
                                "form-stepper-active");
                        }
                    });
                } else if (page == '4') {
                    $(document).on('submit', '#save_per4', function(event) {
                        event.preventDefault();
                        var pesanan_new = $("#save_per4").serialize()
                        var no_order = $('.no_order').val()
                        var member_id = $('.member_id').val()

                        $.ajax({
                            url: "{{ route('tbh_pertanyaan4') }}?" +
                                pesanan_new,
                            method: 'GET',
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    icon: 'success',
                                    title: 'Data berhasil disimpan'
                                });
                            }
                        });

                        var pg = $('.next').val();
                        var next = parseInt(pg) + 1;
                        var tes = $(".next").val(next);
                        load_form4(next);
                    });

                    $(document).on('click', '.bpage', function(event) {
                        var pg = $('.next').val();
                        var next = parseInt(pg) - 1;
                        var tes = $(".next").val(next);
                        load_form4(next);
                    });

                    load_form4(1);

                    function load_form4(next) {

                        $.ajax({
                            method: "GET",
                            url: "{{ route('form4') }}?page=" + next,
                            data: {
                                no_order: no_order,
                                member_id: member_id,
                            },
                            dataType: "html",
                            success: function(hasil) {
                                $('#step-4').html(hasil);
                                $("#step-1").addClass("d-none");
                                $("#step-2").addClass("d-none");
                                $("#step-3").addClass("d-none");
                                $("#step-4").removeClass("d-none");

                                $(".form-stepper-unfinished1").addClass(
                                    "form-stepper-completed");

                                $(".form-stepper-unfinished2").addClass(
                                    "form-stepper-completed");

                                $(".form-stepper-unfinished3").addClass(
                                    "form-stepper-completed");


                                $(".form-stepper-unfinished4").addClass(
                                    "form-stepper-active");
                            }
                        });
                    }
                }
            }

            $(document).on('submit', '#save_per1', function(event) {
                event.preventDefault();
                var pesanan_new = $("#save_per1").serialize()
                var no_order = $('.no_order').val()
                var member_id = $('.member_id').val()
                Swal.fire({
                    title: 'Apakah kamu yakin ?',
                    text: "Pastikan data yg disimpan sudah benar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, saya yakin!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('tbh_pertanyaan1') }}?" + pesanan_new,
                            method: 'GET',
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    icon: 'success',
                                    title: 'Data berhasil disimpan'
                                });
                                $("#step-1").addClass("d-none");
                                $(".form-stepper-active").addClass(
                                    "form-stepper-completed");

                                $("#step-2").removeClass("d-none");
                                $(".form-stepper-unfinished2").addClass(
                                    "form-stepper-active");

                                let stateObj = {
                                    id: "100"
                                };

                                window.history.pushState(stateObj,
                                    "Page 2",
                                    "/kpertanyaan?no_order=" + no_order +
                                    "&member_id=" + member_id +
                                    "&hal=2");

                                var hal = $('.hal').val('2');


                                load_form1(2);
                            }
                        });
                    } else {

                    }
                })


            });

            $(document).on('click', '.back1', function(event) {
                $("#step-2").addClass("d-none");
                $(".form-stepper-unfinished2").removeClass("form-stepper-active");

                $("#step-1").removeClass("d-none");
                $(".form-stepper-unfinished1").addClass("form-stepper-active");
                $(".form-stepper-unfinished1").removeClass("form-stepper-completed");

            });
            $(document).on('click', '.back2', function(event) {
                $("#step-3").addClass("d-none");
                $(".form-stepper-unfinished3").removeClass("form-stepper-active");

                $("#step-2").removeClass("d-none");
                $(".form-stepper-unfinished2").addClass("form-stepper-active");
                $(".form-stepper-unfinished2").removeClass("form-stepper-completed");

            });
            $(document).on('click', '.back3', function(event) {
                $("#step-4").addClass("d-none");
                $(".form-stepper-unfinished4").removeClass("form-stepper-active");

                $("#step-3").removeClass("d-none");
                $(".form-stepper-unfinished3").addClass("form-stepper-active");
                $(".form-stepper-unfinished3").removeClass("form-stepper-completed");
            });

            $(document).on('submit', '#save_per2', function(event) {
                event.preventDefault();
                var pesanan_new = $("#save_per2").serialize()
                var no_order = $('.no_order').val()
                var member_id = $('.member_id').val()
                Swal.fire({
                    title: 'Apakah kamu yakin ?',
                    text: "Pastikan data yg disimpan sudah benar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, saya yakin!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('tbh_pertanyaan2') }}?" + pesanan_new,
                            method: 'GET',
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    icon: 'success',
                                    title: 'Data berhasil disimpan'
                                });
                                $("#step-2").addClass("d-none");
                                $(".form-stepper-active").addClass(
                                    "form-stepper-completed");

                                $("#step-3").removeClass("d-none");
                                $(".form-stepper-unfinished3").addClass(
                                    "form-stepper-active");

                                let stateObj = {
                                    id: "100"
                                };

                                window.history.pushState(stateObj,
                                    "Page 2", "/kpertanyaan?no_order=" +
                                    no_order +
                                    "&member_id=" + member_id +
                                    "&hal=3");
                                var hal = $('.hal').val(3);
                                load_form1(3);
                            }
                        });
                    } else {

                    }
                })


            });

            $(document).on('submit', '#save_per3', function(event) {
                event.preventDefault();
                var pesanan_new = $("#save_per3").serialize()
                var no_order = $('.no_order').val()
                var member_id = $('.member_id').val()
                Swal.fire({
                    title: 'Apakah kamu yakin ?',
                    text: "Pastikan data yg disimpan sudah benar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, saya yakin!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('tbh_pertanyaan3') }}?" + pesanan_new,
                            method: 'GET',
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    icon: 'success',
                                    title: 'Data berhasil disimpan'
                                });
                                $("#step-3").addClass("d-none");
                                $(".form-stepper-active").addClass(
                                    "form-stepper-completed");

                                $("#step-4").removeClass("d-none");
                                $(".form-stepper-unfinished4").addClass(
                                    "form-stepper-active");

                                let stateObj = {
                                    id: "100"
                                };

                                window.history.pushState(stateObj,
                                    "Page 2", "/kpertanyaan?no_order=" + no_order +
                                    "&member_id=" + member_id +
                                    "&hal=4");
                                var hal = $('.hal').val(4);
                                load_form1(4);
                            }
                        });
                    } else {

                    }
                })


            });
        });
    </script>
@endsection
