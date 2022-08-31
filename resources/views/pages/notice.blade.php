<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('pages.layout')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
    


<li class="breadcrumb-item"><a href="./mainHome3.php">Home</a></li>

              <li class="breadcrumb-item active">매입관리</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <!-- /.card -->
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <legend>매입검색</legend>
              </div>

              <div class="card-body" id ="range_search">

                <div class="row">
                        <div class="col-md-6">
                      <div class="form-group">
                        <label>월별 검색</label>

                        <div class="input-group" >
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                          <input type="text" name="reservation" class="form-control" id="month-1">
                          <div class="input-group-append">
                            <input type="button" value="검색" class="btn btn-primary" onclick="mon_search();" id ="add-new-event">
                          </div>
                        </div>
                      </div>

                        </div>
                        <div class="col-md-6">
                      <div class="form-group">
                        <label>기간별 검색</label>

                        <div class="input-group" >
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                          <input type="text" name="" class="form-control" id="reservation3">
                          <div class="input-group-append">
                            <input type="button" value="검색" class="btn btn-primary" onclick="range_search();" id ="add-new-event">
                          </div>
                        </div>

                        <!-- /.input group -->
                      </div>
                      <!-- /.form group -->
                        </div>

                      </div>
                <!-- col -->
              </div>
              <!-- row -->

              <!-- /.card-body -->
            </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card" >
        <div class="card-header">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  <legend>매입관리</legend>
                </div>
                <div class="col-md-7">
                  <div style="float:right;">
                    <!-- <button id="add-new-event" type="button" class="btn btn-outline-primary btn-flat" onclick="insert();">등록</button> -->
                    <input type='button' class="btn btn-outline-primary btn-flat" value='EXCEL 다운로드' onclick="ReportToExcelConverter()" />
                    <button id="add-new-event" type="button" class="btn btn-danger btn-flat" onclick="remove_event();">삭제</button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
               <!-- example1은 선택 가능 search 기능 까지있다. -->
                <thead>
                  <tr>
                  <th><input type="checkbox" name="select_all" value="no" id="example-select-all"></th>
                    <th>작성날짜</th>
                    <!-- <th>등록일</th> -->
                    <th>업체명</th>
                    <th>출금은행</th>
                    <th>금액</th>

                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th colspan="5" style="text-align:right">Total:</th>
                  </tr>
              </tfoot>
            </table>
        </div>


        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>






  </div>
@endsection

@section('script')
<script>
  $(function () {
    //Initialize Select2 Elements


    //Date range picker with time picker 월별 범위 검색 기능
    $('#reservation3').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD',
        },
    });
  })
</script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css">
<script src="../jquery.mtz.monthpicker.js"></script>
<script>
  var date = new Date();
  var year = date.getFullYear();

  $('#month-1').monthpicker({pattern: 'yyyy-mm',
      selectedYear: year,
      startYear: 2016,
      finalYear: 2212,});
    var options = {
      selectedYear: 2015,
      startYear: 2008,
      finalYear: 2018,
      openOnFocus: false // Let's now use a button to show the widget
  };







function range_search() {
var date_time = document.getElementById('reservation3').value;   //선택날자

get_data(date_time);        //ajax 함수로 보내준다
// total_price(date_time);
// table.ajax.reload();
}

function mon_search() {
    var date_time = document.getElementById('month-1').value;   //선택 월

    get_data(date_time);     //ajax 함수로 보내준다.

    // table.ajax.reload();
  }


function get_data(date_time){
    $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type: 'post',

      dataType: 'json',
      url: '/aa',
      contentType :   "application/x-www-form-urlencoded; charset=UTF-8",
      async:false, // 전역변수 설정 변수
      data : {
        test:date_time,
      },
      success: function (retVal) {

        console.log(retVal);
      },
      error: function (request, status, error) {
          console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
          // 오류가 날경우 console창 오류 메세지 출력
      }
    });
}

  </script>
@endsection
