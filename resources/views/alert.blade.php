@if (session('success'))
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success alert-dismissible alert_action mt-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                        <i class="icon fas fa-check"></i>
                        {{ session('success') }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endif
@if (session('info'))
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-info alert-dismissible alert_action mt-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                        <i class="icon fas fa-info"></i>
                        {{ session('info') }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endif
@if (session('warning'))
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-warning alert-dismissible alert_action mt-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                        <i class="icon fas fa-info"></i>
                        {{ session('warning') }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endif
@if (session('danger'))
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissible alert_action mt-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                        <i class="icon fas fa-info"></i>
                        {{ session('danger') }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
@endif
