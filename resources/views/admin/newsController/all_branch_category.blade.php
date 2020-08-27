@extends('admin.home')
@section('all_branch_category')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quản lý danh mục Branch</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Thêm branch mới
                        </button>
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg-12" role="document">
                                <div class="modal-content">
                                    <div class="modal-body ">
                                        <section>
                                            <div>
                                                <div class="row">
                                                    <!-- left column -->

                                                    <div class="col-md-12">
                                                        <!-- general form elements -->
                                                        <div class="card-primary">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Thêm branch mới</h3>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <!-- form start -->
                                                            <form action="{{URL::to('/save-branch-category')}}"
                                                                  method="GET">
                                                                {{ csrf_field() }}
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="id_main_category">Main category</label>
                                                                        <?php
                                                                        $cat = DB::table('main_category')->get();
                                                                        ?>
                                                                        <select class="form-control input-sm m-bot15"
                                                                                name="id_main_category"
                                                                                id="id_main_category">
                                                                            @foreach($cat as $indexcat)
                                                                                <option
                                                                                    value="{{$indexcat->id_main_category}}">{{$indexcat->name_main}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Tên branch</label>
                                                                        <input type="text" class="form-control"
                                                                               name="name_branch" id="name_branch"
                                                                               placeholder="Branch name">
                                                                    </div>

                                                                    <!-- /.card-body -->

                                                                    <div class="card-footer">
                                                                        <button type="submit" name="add_branch"
                                                                                class="btn btn-primary">Thêm branch
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end form -->
                        <br></br>
                        <!-- alert Edit -->
                        @if(isset($checkedit))
                            <br/>
                            <div class="row">
                                <div class="col-12">
                                    @if($checkedit == true)
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">x</button>
                                            <strong id="alert-header">{{$alert}}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                    @endif
                    <!-- end alertEdit -->

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 18%">ID Branch</th>
                                <th style="width: 20%">Tên Main tương ứng</th>
                                <th>Tên Branch</th>
                                <th>Chỉnh sửa</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allBranchCategory  as $eachBranchCategory)
                                <?php
                                $mainCategoryOnly = DB::table('main_category')->where('id_main_category', $eachBranchCategory->id_main_category)->get()->first();    //chứa 1 bản ghi trong bảng main
                                ?>
                                <tr>
                                    <td class="text-center">{{ $eachBranchCategory->id_branch_category }}</td>
                                    <td class="text-center">
                                        <a style="color: red"
                                           href="{{URL::to('/edit-main-category/'.$mainCategoryOnly->id_main_category) }}">
                                            {{$mainCategoryOnly->name_main}}
                                        </a>
                                    </td>
                                    <td>
                                        <a style="color: darkorange"
                                           href="{{URL::to('/news-result-'.$eachBranchCategory->id_branch_category) }}">
                                            {{ $eachBranchCategory->name_branch }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-branch-category/'.$eachBranchCategory->id_branch_category)}}">Sửa branch</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div>
                            <br/>
                            <div style="float: right">
                                {!! $allBranchCategory->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@endsection
