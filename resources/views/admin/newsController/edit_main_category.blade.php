@extends('admin.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa main</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-main')}}" method="GET">
                            <input type="hidden" name="id_main_category"
                                   value="{{$edit_main_category->id_main_category}}">

                            <div class="form-group">
                                <label>Tên main</label>
                                <input type="text" name="name_main" class="form-control" id="name_main"
                                       value="{{$edit_main_category->name_main}}">
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa main</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
