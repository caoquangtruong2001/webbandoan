@extends('client.layouts.index')

@section('client_head')
    <meta name="description" content="{{ hwa_page_title("Thanh toán") }}">
    <meta name="keywords" content="{{ hwa_page_title("Thanh toán") }}">

    <!-- SITE TITLE -->
    <title>{{ hwa_page_title("Thanh toán") }}</title>
@endsection

@section('client_main')
    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container"><!-- STRART CONTAINER -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Thanh toán</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end">
                        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thanh toán</li>
                    </ol>
                </div>
            </div>
        </div><!-- END CONTAINER-->
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- START MAIN CONTENT -->
    <div class="main_content">

        <!-- START SECTION SHOP -->
        <div class="section">
            <div class="container">
                <form action="{{ route("client.checkout") }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="heading_s1">
                                <h4>Chi tiết hóa đơn</h4>
                            </div>

                            <div class="form-group mb-3">
                                <select name="customer_address_id" class="form-control" id="customer_address_id">
                                    <option value="">--- Chọn địa chỉ giao hàng ---</option>
                                    @foreach($addresses as $address).
                                        <option value="{{ $address['id'] }}" {{ $address['is_default'] == '1' ? "selected" : "" }}>{{ $address['name'] . ' - ' . $address['phone'] . ' - (' . $address['address'] . ')' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <select name="select-address" class="form-control" >
                                    <option value="">--- Chọn chi nhánh  ---</option>
                                    <option >ChickenD KFC 483 Lạc Long Quân, Tây Hồ, Hà Nội</option>
                                    <option >ChickenD KFC 3C Lê Thái Tổ, Hoàn Kiếm, Hà Nội</option>
                                    <option >ChickenD KFC 372-374 Cầu Giấy, Cầu Giấy, Hà Nội</option>
                                    <option >ChickenD KFC Toà nhà C7 Thanh Xuân Bắc, Thanh Xuân, Hà Nội</option>
                                    <option >ChickenD KFC 11A7 Trần Đại Nghĩa, Hai Bà Trưng, Hà Nội</option>
                                    <option >ChickenD KFC 87 Nguyễn Thái Học, Ba Đình, Hà Nội</option>
                                    <option >ChickenD KFC 405 Nguyễn Văn Cừ, Long Biên, Hà Nội</option>
                                    <option >ChickenD KFC Vincom Phạm ngọc thạch</option>
                                    <option >ChickenD KFC Số 32 Thái thịnh</option>
                                    <option >ChickenD KFC 21 Hoàn kiếm</option>
                                    <option >ChickenD KFC 19 Ngọc Hồi</option>
                                </select>
                            </div>

                            <div class="heading_s1 mt-3">
                                <h4 class="mt-5">Thông tin thêm</h4>
                            </div>
                            <div class="form-group mb-0">
                                <textarea rows="5" class="form-control" name="comment" placeholder="Ghi chú đơn hàng"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="order_review">
                                <div class="heading_s1">
                                    <h4>Thông tin đơn hàng</h4>
                                </div>
                                <div class="table-responsive order_table">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cart as $item)
                                            <tr>
                                                <td>{{ $item['product_name'] }} <span class="product-qty">x {{ $item['quantity'] }}</span></td>
                                                <td>{{ number_format(intval($item['product_price']) * intval($item['quantity']) ?? 0) }} đ</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Tạm tính</th>
                                            <td class="product-subtotal">{{ number_format($subtotal ?? 0) }} đ</td>
                                        </tr>
                                        <tr>
                                            <th>Phí ship </th>
                                            <td>{{ number_format(10000) }} đ</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng tiền</th>
                                            <td class="product-subtotal">{{ number_format(($total) ?? 0) }} đ</td>
                                            <input type="hidden" name="total" value="{{ $total }}">
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="payment_method">
                                    <div class="heading_s1">
                                        <h4>Phương thức thanh toán</h4>
                                    </div>
                                    <div class="payment_option">
                                        <div class="custome-radio">
                                            <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" value="cod" checked="">
                                            <label class="form-check-label" for="exampleRadios3">Thanh toán trực tiếp</label>
                                            <p data-method="cod" class="payment-text">Quý khách trả tiền mặt cho nhân viên tại các chi nhánh của chúng tôi hoặc là liên hệ trực tiếp để nhận hỗ trợ. </p>
                                        </div>
                                        <div class="custome-radio">
                                            <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios4" value="vnpay">
                                            <label class="form-check-label" for="exampleRadios4">Thanh toán online VnPay</label>
                                            <p data-method="vnpay" class="payment-text">Quý khách có thể thanh toán qua các ngân hàng liên kết với Vnpay tính đến thời điểm hiện tại: Vietcombank, BIDV, MBBank, VietinBank, Agribank, SCB, VPBank, HDBank, Viet Capital Bank, IVB, Eximbank, SHB, TP Bank, Maritime Bank, VIB, NCB, Nam A Bank, BAC A BANK, OCB, TVB, Vietbank, ABbank, Woori Bank.</p>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-fill-out btn-block" type="submit">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SECTION SHOP -->

    </div>
    <!-- END MAIN CONTENT -->
@endsection
