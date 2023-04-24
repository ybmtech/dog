@extends('layouts.backend',['title'=>'Dashboard'])

@section('content')
    
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">2</h2>
            <span class="desc">Breeding</span>
            <div class="icon">
                <i class="zmdi zmdi-account-o"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">Dogs</h2>
            <span class="desc">{{ $dogs }}</span>
            <div class="icon">
                <i class="fas fa-table"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $orders }}</h2>
            <span class="desc">Orders</span>
            <div class="icon">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $paid_orders }}</h2>
            <span class="desc">Paid Orders</span>
            <div class="icon">
                <i class="zmdi zmdi-money"></i>
            </div>
        </div>
    </div>
</div>

  {{-- user data --}}
  <div class="row">
    <div class="col-xl-12">
        <!-- USER DATA-->
        <div class="user-data m-b-40">
            <h3 class="title-3 m-b-30">
                <i class="zmdi zmdi-account-calendar"></i>user data</h3>
          
            <div class="table-responsive table-data">
                <table class="table">
                    <thead>
                        <tr>
                            <td>
                                <label class="au-checkbox">
                                    <input type="checkbox">
                                    <span class="au-checkmark"></span>
                                </label>
                            </td>
                            <td>name</td>
                            <td>role</td>
                            <td>type</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label class="au-checkbox">
                                    <input type="checkbox">
                                    <span class="au-checkmark"></span>
                                </label>
                            </td>
                            <td>
                                <div class="table-data__info">
                                    <h6>lori lynch</h6>
                                    <span>
                                        <a href="#">johndoe@gmail.com</a>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="role admin">admin</span>
                            </td>
                            <td>
                                <div class="rs-select2--trans rs-select2--sm">
                                    <select class="js-select2" name="property">
                                        <option selected="selected">Full Control</option>
                                        <option value="">Post</option>
                                        <option value="">Watch</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </td>
                            <td>
                                <span class="more">
                                    <i class="zmdi zmdi-more"></i>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="au-checkbox">
                                    <input type="checkbox" checked="checked">
                                    <span class="au-checkmark"></span>
                                </label>
                            </td>
                            <td>
                                <div class="table-data__info">
                                    <h6>lori lynch</h6>
                                    <span>
                                        <a href="#">johndoe@gmail.com</a>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="role user">user</span>
                            </td>
                            <td>
                                <div class="rs-select2--trans rs-select2--sm">
                                    <select class="js-select2" name="property">
                                        <option value="">Full Control</option>
                                        <option value="" selected="selected">Post</option>
                                        <option value="">Watch</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </td>
                            <td>
                                <span class="more">
                                    <i class="zmdi zmdi-more"></i>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="au-checkbox">
                                    <input type="checkbox">
                                    <span class="au-checkmark"></span>
                                </label>
                            </td>
                            <td>
                                <div class="table-data__info">
                                    <h6>lori lynch</h6>
                                    <span>
                                        <a href="#">johndoe@gmail.com</a>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="role user">user</span>
                            </td>
                            <td>
                                <div class="rs-select2--trans rs-select2--sm">
                                    <select class="js-select2" name="property">
                                        <option value="">Full Control</option>
                                        <option value="" selected="selected">Post</option>
                                        <option value="">Watch</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </td>
                            <td>
                                <span class="more">
                                    <i class="zmdi zmdi-more"></i>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="au-checkbox">
                                    <input type="checkbox">
                                    <span class="au-checkmark"></span>
                                </label>
                            </td>
                            <td>
                                <div class="table-data__info">
                                    <h6>lori lynch</h6>
                                    <span>
                                        <a href="#">johndoe@gmail.com</a>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="role member">member</span>
                            </td>
                            <td>
                                <div class="rs-select2--trans rs-select2--sm">
                                    <select class="js-select2" name="property">
                                        <option selected="selected">Full Control</option>
                                        <option value="">Post</option>
                                        <option value="">Watch</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </td>
                            <td>
                                <span class="more">
                                    <i class="zmdi zmdi-more"></i>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
           
        </div>
        <!-- END USER DATA-->
    </div>
  </div>
@endsection
