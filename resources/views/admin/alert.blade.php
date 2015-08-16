<div class="row">
    <div class="col-md-12">
        @if (Session::has('alert'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('alert') }}
            </div>
        @endif
    </div>
</div>