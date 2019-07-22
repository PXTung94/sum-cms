

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Basic Forms</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Forms</span></li>
                <li><span>Basic</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    {{-- search --}}
    <form action="{{ url('/sum') }}" class="search nav-form">
        <div class="input-group input-search">
            <input type="text" class="form-control" name="code" id="code" placeholder="Nhập mã công ty...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>

    <!-- start: page -->
        <div class="row">
            <div class="col-lg-4">
                    <section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>

								<h2 class="panel-title">Danh sách khách hàng</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Tên</th>
											<th>Mã</th>
											<th></th>
											{{-- <th class="hidden-phone">Engine version</th>
											<th class="hidden-phone">CSS grade</th> --}}
										</tr>
									</thead>
									<tbody>
                                        @if (session('_listPatientSum') !== null)
                                            @foreach (session('_listPatientSum') as $oneP)
                                                <tr class="">
                                                    <td>{{ $oneP->fullname }}</td>
                                                    <td>{{ $oneP->filenum }}</td>
                                                    <td><a href="javascript:void(0)" class="btn btn-default ajax-getSum" data-filenum="{{ $oneP->filenum }}" >Chọn</a></td>
                                                    {{-- <td class="center hidden-phone">X</td> --}}
                                                </tr>
                                            @endforeach
                                        @endif

									</tbody>
								</table>
							</div>
						</section>
            </div>
            <div class="col-lg-8">
                    <section class="panel">
							<header class="panel-heading">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
								<div class="panel-actions">
                                    <a href="javascript:void(0)" class="mb-xs mt-xs mr-xs btn btn-primary ajax-getUpdateSum"  style="width: 100%;height: 33px;">Cập nhật</a>

								</div>
								<h2 class="panel-title">Kết quả Sum</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th width="15%"></th>
											<th width="20%">Kết luận</th>
											<th width="40%">Lời khuyên</th>
											<th width="10%">Normal</th>
											<th width="5%">PLSK</th>
											{{-- <th width="10%"></th> --}}
											{{-- <th class="hidden-phone">Engine version</th>
											<th class="hidden-phone">CSS grade</th> --}}
										</tr>
									</thead>
									<tbody id="resultKQ">

									</tbody>
                                </table>
							</div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="panel-actions">
                                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                                </div>

                                <h2 class="panel-title">Tổng kết</h2>
                            </header>
                            <div class="panel-body">
                                <form id="SumResult" class="form-horizontal form-bordered" method="get">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="inputDefault">Nhận xét</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="inputDefault">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="inputDefault">Ghi chú</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="inputDefault">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label class="col-md-3 control-label" for="inputDefault">Id</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="inputDefault">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label class="col-md-3 control-label" for="inputDefault">patient_id</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="inputDefault">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <input type="button" class="form-control input-block change-Normal" value="Chưa Sum">

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </section>

            </div>
        </div>


    <!-- end: page -->
</section>
<!-- Specific Page Vendor -->
<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
<!-- Examples -->
<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('a.ajax-getSum').click(function(){
            var pId= $(this).attr('data-filenum');
            $.get("{{ url('/act_getSum') }}"+"?filenum="+pId, function(data, status){
            var KQCLSHtml='';
            var KQKLSHtml='';
            $('#resultKQ').html("");
            for(var KQKLS in data['KQKLS']){
                if(data['KQKLS'][KQKLS]['KetQuaLamSangID'] != null){
                    var Normal='';
                    if(data['KQKLS'][KQKLS]['Normal']==0){ Normal="Bất Thường";}else if(data['KQKLS'][KQKLS]['Normal']==1){ Normal="Bình Thường";}
                    KQKLSHtml = '<tr class="KQKLS"><td >' + data['KQKLS'][KQKLS]['Ten'] + '</td><td ><input type="text" class="form-control input-block" value="' + data['KQKLS'][KQKLS]['Note'] + '"></td><td ><input type="text" class="form-control input-block" value="' + data['KQKLS'][KQKLS]['LoiKhuyen'] + '"></td><td ><input type="button" class="form-control input-block change-Normal" value="' + Normal + '"></td><td ><input type="text" class="form-control input-block" value="' + data['KQKLS'][KQKLS]['PhanLoaiSucKhoe'] + '"></td><td style="display:none;">'+data['KQKLS'][KQKLS]['KetQuaLamSangID']+'</td></tr>';
                    $('#resultKQ').append(KQKLSHtml);
                }
            }
            for(var KQCLS in data['KQCLS']){
                if(data['KQCLS'][KQCLS]['CanLamSangID'] != null){
                    var Result='';
                    if(data['KQCLS'][KQCLS]['Result']==0){
                        Result="Bất Thường";
                    }else if(data['KQCLS'][KQCLS]['Result']==1){
                        Result="Bình Thường";
                    }else if(data['KQCLS'][KQCLS]['Result']==2){
                        Result="Dương Tính";
                    }else if(data['KQCLS'][KQCLS]['Result']==3){
                        Result="Âm Tính";
                    }
                    KQCLSHtml = '<tr class="KQCLS"><td >' + data['KQCLS'][KQCLS]['TenDVKT'] + '</td><td ><input type="text" class="form-control input-block" value="' + data['KQCLS'][KQCLS]['TrieuChung'] + '"></td><td ><input type="text" class="form-control input-block" value="' + data['KQCLS'][KQCLS]['LoiKhuyen'] + '"></td><td ><input type="button" class="form-control input-block change-Result" value="' + Result + '"></td><td> </td><td style="display:none;">'+data['KQCLS'][KQCLS]['CanLamSangID']+'</td></tr>';
                    $('#resultKQ').append(KQCLSHtml);
                }
            }

            if(data['SumResult'].length ==0){
                $('form#SumResult div.form-group').eq(0).find('input').val('');
                $('form#SumResult div.form-group').eq(1).find('input').val('');
                $('form#SumResult div.form-group').eq(2).find('input').val('');
                $('form#SumResult div.form-group').eq(4).find('input').val('Chưa Sum');
            }
            else{
                $('form#SumResult div.form-group').eq(0).find('input').val(data['SumResult'][0]['nhanxet']);
                $('form#SumResult div.form-group').eq(1).find('input').val(data['SumResult'][0]['ghichu']);
                $('form#SumResult div.form-group').eq(2).find('input').val(data['SumResult'][0]['id']);
                if(data['SumResult'][0]['sum']==1){
                    $('form#SumResult div.form-group').eq(4).find('input').val('Đã Sum');
                }
            }
            $('form#SumResult div.form-group').eq(3).find('input').val(data['Patient_id']);
            });
        });
        $('a.ajax-getUpdateSum').click(function(){
            var tbody = $('tbody#resultKQ');       // Finds the closest row <tr>
            var KQCLS = [];
            var KQKLS = [];
            var SumResult = {};
            $(tbody).find('tr.KQCLS').each(function (itr, tr) {
                var rowKQCLS = {};
                rowKQCLS['TenDVKT'] = $(tr).find('td').eq(0).text().trim();
                rowKQCLS['TrieuChung'] = $(tr).find('td').eq(1).find('input').val().trim();
                rowKQCLS['LoiKhuyen'] = $(tr).find('td').eq(2).find('input').val().trim();
                rowKQCLS['Result'] = $(tr).find('td').eq(3).find('input').val().trim();
                rowKQCLS['CanLamSangID'] = $(tr).find('td').eq(5).text().trim();
                KQCLS.push(rowKQCLS);
            });
            $(tbody).find('tr.KQKLS').each(function (itr, tr) {
                var rowKQKLS = {};
                rowKQKLS['Ten'] = $(tr).find('td').eq(0).text().trim();
                rowKQKLS['Note'] = $(tr).find('td').eq(1).find('input').val().trim();
                rowKQKLS['LoiKhuyen'] = $(tr).find('td').eq(2).find('input').val().trim();
                rowKQKLS['Normal'] = $(tr).find('td').eq(3).find('input').val().trim();
                rowKQKLS['PhanLoaiSucKhoe'] = $(tr).find('td').eq(4).find('input').val().trim();
                rowKQKLS['KetQuaLamSangID'] = $(tr).find('td').eq(5).text().trim();
                KQKLS.push(rowKQKLS);
            });
            SumResult['nhanxet'] = $('form#SumResult div.form-group').eq(0).find('input').val().trim();
            SumResult['ghichu'] = $('form#SumResult div.form-group').eq(1).find('input').val().trim();
            SumResult['id'] = $('form#SumResult div.form-group').eq(2).find('input').val().trim();
            SumResult['patient_id'] = $('form#SumResult div.form-group').eq(3).find('input').val().trim();
            SumResult['sum'] = $('form#SumResult div.form-group').eq(4).find('input').val().trim();
            // Send the data using post

            $.ajax({
            type:'POST',
            url:"{{ url('/act_updateKQCLS') }}",
            data:{ data: KQCLS },
            success:function(data){
                console.log(data);
                if(data==1){
                    new PNotify({
                    title: 'Cập nhật KQCLS thành công!',
                    type: 'success'
                    });
                }else{
                    new PNotify({
                    title: 'Cập nhật KQCLS thất bại!',
                    type: 'error'
                    });
                }
            }
            });
            $.ajax({
            type:'POST',
            url:"{{ url('/act_updateKQKLS') }}",
            data:{ data: KQKLS },
            success:function(data){
                console.log(data);
                if(data==1){
                    new PNotify({
                    title: 'Cập nhật KQKLS thành công!',
                    type: 'success'
                    });
                }else{
                    new PNotify({
                    title: 'Cập nhật KQKLS thất bại!',
                    type: 'error'
                    });
                }

            }
            });
            $.ajax({
            type:'POST',
            url:"{{ url('/act_updateSumResult') }}",
            data:{ data: SumResult },
            success:function(data){
                console.log(data);
                if(data==1){
                    new PNotify({
                    title: 'Cập nhật SumResult thành công!',
                    type: 'success'
                    });
                }else{
                    new PNotify({
                    title: 'Cập nhật SumResult thất bại!',
                    type: 'error'
                    });
                }

            }
            });

            // $.each($tds, function() {                // Visits every single <td> element
            //     console.log($(this).text());         // Prints out the text within the <td>
            // });
        });
        $('form#SumResult div.form-group').eq(4).find('input').click(function() {
            if($(this).val() == 'Đã Sum'){
                $(this).val('Chưa Sum');
            }else{
                $(this).val('Đã Sum');
            }
        });
        $("tbody#resultKQ").on("click","input.change-Normal", function(){
            if($(this).val() == 'Bình Thường'){
                $(this).val('Bất Thường');
            }else{
                $(this).val('Bình Thường');
            }
        });
        $("tbody#resultKQ").on("click","input.change-Result", function(){
            if($(this).val() == 'Bình Thường'){
                $(this).val('Bất Thường');
            }else if($(this).val() == 'Bất Thường'){
                $(this).val('Bình Thường');
            }else if($(this).val() == 'Dương Tính'){
                $(this).val('Âm Tính');
            }else if($(this).val() == 'Âm Tính'){
                $(this).val('Dương Tính');
            }
        });
    });


</script>
