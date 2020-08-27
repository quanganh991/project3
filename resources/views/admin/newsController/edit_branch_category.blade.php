@extends('admin.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa branch</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{URL::to('/submit-edit-branch')}}" method="GET">
                            <input type="hidden" name="id_branch_category"
                                   value="{{$edit_branch_category->id_branch_category}}">
                            <div class="form-group">
                                <label>Tên của Main chứa branch</label>
                                <?php
                                $cat = DB::table('main_category')->get();
                                ?>
                                <select  class="form-control input-sm m-bot15" name="id_main_category" id="id_main_category" >
                                    @foreach($cat as $indexcat)
                                        <option
                                            <?php if($indexcat->id_main_category ==  $edit_branch_category->id_main_category) echo "selected" ?>
                                            value="{{$indexcat->id_main_category}}">{{$indexcat->name_main}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tên branch</label>
                                <input type="text" name="name_branch" class="form-control" id="name_branch"
                                       value="{{$edit_branch_category->name_branch}}">
                            </div>

                            <button type="submit" name="edit_submit" class="btn btn-info">Xác nhận sửa branch</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
