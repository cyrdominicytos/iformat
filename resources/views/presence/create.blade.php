@extends('layouts.app_layouts')

@section('css')
<style>
    td {
        text-align: center;
    }
</style>
@endsection()
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> Gestion des présences aux sessions de formation</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted text-capitalize">Session de formation</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Présence des participants</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-1">
                <!--begin::Wrapper-->
                <div class="me-4">

                </div>
                <!--end::Wrapper-->

            </div>
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h4 class="fw-bolder text-dark">{{ isset($old_planning) ? "Edition" : "Ajout"}} d'une présence</h4>
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <div class="row">
                        <form class="form" action="<?= isset($old_planning) ? route('listPresence.update') : route('listPresence.store') ?>" method="post" id="create_modal_from">
                            @csrf
                            @isset($old_planning):
                            <input type="hidden" name="id" id="old_id" value="{{$old_planning->plannings_id}}">
                            @endisset

                            <div class="col-md-12">
                                <div class="row fv-row fv-plugins-icon-container" _mstvisible="11">
                                    <!--begin::Col-->
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Formation</label>
                                            <select name="plannings_learning_id" data-control="select2" data-placeholder="Choisissez la formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_learning_id">
                                                @if(isset($old_planning))
                                                @foreach($learning_list as $key=> $list)
                                                <option value="{{$list->learnings_id}}" <?= $list->learnings_id == $old_planning->plannings_learning_id ? 'selected' : '' ?> title="{{$list->learnings_code}} : {{$list->learnings_title2}}">{{$list->learnings_title}}</option>
                                                @endforeach
                                                @else
                                                @foreach($learning_list as $key=> $list)
                                                <option value="{{$list->learnings_id}}" <?= old('plannings_learning_id') !== null ? ($list->learnings_id == old('plannings_learning_id') ? 'selected' : '') : '' ?> title="{{$list->learnings_code}} : {{$list->learnings_title2}}">{{$list->learnings_title}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('plannings_learning_id'))
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                <div data-field="plannings_learning_id" data-validator="notEmpty">{{$errors->first('plannings_learning_id')}}</div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Session</label>
                                            <select name="plannings_classroom_id" data-control="select2" data-placeholder="Choisissez le site de formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_classroom_id">

                                            </select>
                                            @if($errors->has('plannings_classroom_id'))
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                <div data-field="plannings_classroom_id" data-validator="notEmpty">{{$errors->first('plannings_classroom_id')}}</div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row fv-row fv-plugins-icon-container" _mstvisible="11">
                                    <!--begin::Col-->
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Date et Heure</label>
                                            <select name="plannings_datetime" data-control="select2" data-placeholder="Choisissez la date et heure de formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_datetime">
                                                @if(isset($old_planning))
                                                @foreach($learning_list as $key=> $list)
                                                <option value="{{$list->learnings_id}}" <?= $list->learnings_id == $old_planning->plannings_learning_id ? 'selected' : '' ?>>{{$list->learnings_code}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <!--begin::Col-->
                                    <div class="col-md-6" _mstvisible="12">
                                        <div class="d-flex flex-column mb-5 fv-row  text-dark">
                                            <label class="form-label fw-bolder text-dark fs-6 required">Groupe</label>
                                            <select name="plannings_group" data-control="select2" data-placeholder="Choisissez le groupe de formation..." class="form-select form-select-solid form-select-lg fw-bold select2-hidden-accessible" data-select2-id="select2-data-10-02r3" tabindex="-1" aria-hidden="true" id="plannings_group">

                                            </select>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <h4 class="fw-bolder text-dark text-center mt-5 mb-5">Marquer la présence des participants</h4>
                                <!--begin:: Tout cochez Col-->
                                <div class="col-md-6 offset-md-3 fv-row mt-5 text-center">
                                    <div class="d-flex flex-stack mb-8">
                                        <!--begin::Label-->
                                        <div class="me-5">
                                            <div class="fs-7 fw-bolder text-dark  text-center">Souhaitez-vous cocher tous les participants ?</div>
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" id="check_all" name="check_all">
                                            <span class="form-check-label fw-bolder text-dark">Tout cocher</span>
                                        </label>
                                        <!--end::Switch-->
                                    </div>
                                </div>

                                <div>
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_slot" style="">
                                        <!--begin::Table head-->
                                        <thead>
                                            <!--begin::Table row-->
                                            <tr class="text-center text-muted fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="text-en min-w-100px">Actions</th>
                                                <th class="min-w-125px">Noms et Prénoms</th>
                                            </tr>
                                            <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-bold">

                                            @if($errors->has('participant'))
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <div class="fv-plugins-message-container invalid-feedback text-center">
                                                        <div data-field="participant" data-validator="notEmpty">{{$errors->first('participant')}}</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    <!--begin::Modal footer-->
                                    <div class="modal-footer flex-center" style="margin-top: 10px">
                                        <!--begin::Button-->
                                        <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-danger me-3" onclick="history.go(-1)">Quitter</button>
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        @if(in_array(Auth::user()->user_role_id,[3]))
                                        <button type="submit" id="submit" class="btn btn-primary">
                                            <span class="indicator-label" id="submitText">Enregistrer</span>
                                            <span class="indicator-progress">Patientez...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                        @endif
                                    </div>
                                    <!--end::Modal footer-->
                                </div>
                        </form>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@section('js')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var old_planning = <?php echo isset($old_planning) ? json_encode($old_planning) : (0); ?>;
    var base_url = "<?= URL::to('/') ?>";
    var plannings_date1 = document.getElementById("plannings_date");
    var plannings_time_slot1 = document.getElementById("plannings_time_slot");
    var table_unique = [];
    var old_table_data = <?php echo isset($old_table_data) ? json_encode($old_table_data) : (0); ?>;



    //Information dialog 
    function message_dialog(mes) {
        Swal.fire({
            html: mes,
            icon: "info",
            buttonsStyling: false,
            confirmButtonText: "C'est compris!",
            customClass: {
                confirmButton: "btn btn-primary",
            }
        }).then((result) => {
            if (result.value)
                console.log(result.value);
        });
    }

    $(window).on('load', function() {

        document.getElementById("plannings_learning_id").dispatchEvent(new Event('change'));
        if (old_planning != 0) {
            table_unique = old_table_data;
            document.getElementById("submit").disabled = false;
        }
    });


    //learning change set time slot
    $('#plannings_learning_id').change(function() {

        if ($(this).val() != '') {
            var value = $(this).val();
            //load product code
            $.ajax({
                url: "<?= route('listPresence.planning_list') ?>",
                type: "POST",
                data: {
                    id: value,
                },
                success: function(result) {
                    //sessions
                    $('#plannings_classroom_id').html(result);
                    document.getElementById("plannings_classroom_id").dispatchEvent(new Event('change'));

                }
            });

            //load product code
            /*if(old_planning!=0){
                console.log(value+' '+old_planning['plannings_learning_id'])
                if(old_planning['plannings_learning_id'] == value){
                    $.ajax({
                        url: "<?= route('listPlannings.learning_available_groupe2') ?>",
                        type:"POST",
                        data:{
                            id:value,
                            session_id:old_planning['plannings_id'],
                        },
                        success:function(result)
                        {
                        $('#plannings_user_groups').html(result);
                        }
                    });
                    console.log(value+' '+old_planning['plannings_id'])
                }else{
                    //update other learning session
                    $.ajax({
                        url: "<?= route('listPlannings.learning_available_groupe') ?>",
                        type:"POST",
                        data:{
                            id:value,
                        },
                        success:function(result)
                        {
                        $('#plannings_user_groups').html(result);
                        }
                    });
                    console.log(2)
                }
              }else{
                $.ajax({
                    url: "<?= route('listPlannings.learning_available_groupe') ?>",
                    type:"POST",
                    data:{
                        id:value,
                    },
                    success:function(result)
                    {
                    $('#plannings_user_groups').html(result);
                    }
                });
                console.log(3)
              }*/



        }
    });

    //learning change set time slot
    $('#plannings_classroom_id').change(function() {

        if ($(this).val() != '') {
            var value = $(this).val();
            //load product code
            $.ajax({
                url: "<?= route('listPresence.planning_details_list') ?>",
                type: "POST",
                data: {
                    id: value,
                },

                success: function(result) {
                    $('#plannings_group').html(result.groups);
                    $('#plannings_datetime').html(result.date);
                    document.getElementById("plannings_group").dispatchEvent(new Event('change'));

                }
            });

            //load product code
            /*if(old_planning!=0){
                console.log(value+' '+old_planning['plannings_learning_id'])
                if(old_planning['plannings_learning_id'] == value){
                    $.ajax({
                        url: "<?= route('listPlannings.learning_available_groupe2') ?>",
                        type:"POST",
                        data:{
                            id:value,
                            session_id:old_planning['plannings_id'],
                        },
                        success:function(result)
                        {
                        $('#plannings_user_groups').html(result);
                        }
                    });
                    console.log(value+' '+old_planning['plannings_id'])
                }else{
                    //update other learning session
                    $.ajax({
                        url: "<?= route('listPlannings.learning_available_groupe') ?>",
                        type:"POST",
                        data:{
                            id:value,
                        },
                        success:function(result)
                        {
                        $('#plannings_user_groups').html(result);
                        }
                    });
                    console.log(2)
                }
              }else{
                $.ajax({
                    url: "<?= route('listPlannings.learning_available_groupe') ?>",
                    type:"POST",
                    data:{
                        id:value,
                    },
                    success:function(result)
                    {
                    $('#plannings_user_groups').html(result);
                    }
                });
                console.log(3)
              }*/



        }
    });
    //learning change set time slot
    $('#plannings_group').change(function() {

        if ($(this).val() != '') {
            var value = $(this).val();
            //load product code
            //let date_time = $('#plannings_group').val().split(" de ");
            $.ajax({
                url: "<?= route('listPresence.group_participant_list') ?>",
                type: "POST",
                data: {
                    id: value,
                    date_time: $('#plannings_datetime').val(),
                },

                success: function(result) {
                    $("table tbody").html(result);
                    // document.getElementById("table_slot").tBodies.innerHTML = result
                    //$('#table_slot'). html(result);
                }
            });

            //load product code
            /*if(old_planning!=0){
                console.log(value+' '+old_planning['plannings_learning_id'])
                if(old_planning['plannings_learning_id'] == value){
                    $.ajax({
                        url: "<?= route('listPlannings.learning_available_groupe2') ?>",
                        type:"POST",
                        data:{
                            id:value,
                            session_id:old_planning['plannings_id'],
                        },
                        success:function(result)
                        {
                        $('#plannings_user_groups').html(result);
                        }
                    });
                    console.log(value+' '+old_planning['plannings_id'])
                }else{
                    //update other learning session
                    $.ajax({
                        url: "<?= route('listPlannings.learning_available_groupe') ?>",
                        type:"POST",
                        data:{
                            id:value,
                        },
                        success:function(result)
                        {
                        $('#plannings_user_groups').html(result);
                        }
                    });
                    console.log(2)
                }
              }else{
                $.ajax({
                    url: "<?= route('listPlannings.learning_available_groupe') ?>",
                    type:"POST",
                    data:{
                        id:value,
                    },
                    success:function(result)
                    {
                    $('#plannings_user_groups').html(result);
                    }
                });
                console.log(3)
              }*/



        }
    });


    $("#check_all").click(function(e) {
        $('.participant_checkbox').prop("checked", e.target.checked);
    })
</script>
@endsection
@endsection