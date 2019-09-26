@extends('layouts.admin')
@section('pageTitle', 'Compose')
@section('content')
<div class="content-wrapper">
  <section class="content">
      <div class="row">
          <div class="col-sm-12">
              <div class="mailbox">
                <div class="mailbox-header">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="inbox-avatar">
                        <div class="inbox-avatar-text hidden-xs hidden-sm">
                          <div><i class="fa fa-mail-forward"></i> <small>Compose Message</small></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-8">
                      <div class="inbox-toolbar btn-toolbar">            
                      </div>
                    </div>
                  </div>
                </div>

                <div class="mailbox-body">
                  <div class="row m-0">
                    <div class="col-sm-3 p-0 inbox-nav hidden-xs hidden-sm">
                      <div class="mailbox-sideber">
                        <div class="profile-usermenu">
                          <h6>Compose Message</h6>
                          <ul class="nav">
                            <li><a href="{{ url('/admin/mail') }}"><i class="fa fa-inbox"></i>Inbox <small class="label pull-right bg-green">{{ $countmail }}</small></a></li>
                            <li><a href="{{ url('/admin/compose') }}"><i class="fa fa-envelope-o"></i>Send Mail</a></li>
                             <li><a href="{{ url('/admin/sentmail') }}"><i class="fa fa-file-text-o"></i>Sent</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>

                      <div class="col-xs-12 col-sm-12 col-md-9 p-0 inbox-mail p-20">
                        @if(isset($status))
                          <div class="alert alert-success alert-dismissable" style="margin:20px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4>  <i class="icon fa fa-check"></i> Success!</h4>
                            {{ $status}}
                          </div>
                        @endif

                        @if(isset($error))
                          <div class="alert alert-danger alert-dismissable" style="margin:20px">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4>  <i class="icon fa fa-times"></i> Oops!</h4>
                              {{ $error}}
                          </div>
                        @endif
                        <form method="post" class="profile-wrapper" action="{{ url('admin/compose') }}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                          <div class="form-group row">
                            <label class="col-sm-3 col-md-2 col-form-label text-right">Your Name :</label>
                            <div class="col-sm-9 col-md-10">
                              <input class="form-control" type="text" name="name" required="">
                            </div>
                          </div>
                          @if((Auth::user()->role!="Sales Rep") && (Auth::user()->role!="Marketer") && (Auth::user()->role!="Zalla Admin") && (Auth::user()->role!="Entrance Admin"))
                            <input type="hidden" name="to" value="Admin">
                            <input type="hidden" name="from" value="{{ Auth::user()->school_code }}">
                            <input type="hidden" name="school_code" value="{{ Auth::user()->school_code }}">
                            <input type="hidden" name="msg_id" value="{{ rand(0, 10000) }}">
                            <!--<div class="form-group row">
                              <label class="col-sm-3 col-md-2 col-form-label text-right">To :</label>
                              <div class="col-sm-9 col-md-10">

                                <input class="form-control" type="text" name="to" id="to" required="" placeholder="School Code eg HSM/2019/0001">
                              </div>
                            </div>-->
                          @else
                            <div class="form-group row">
                              <label class="col-sm-3 col-md-2 col-form-label text-right">To :</label>
                              <div class="col-sm-9 col-md-10">
                                <input class="form-control" type="text" id="search" name="to" required="" placeholder="Put the school code eg HSM/2019/0002">
                                <div id="keyput"></div>
                              </div>
                            </div>
                            <input type="hidden" name="from" value="Admin">
                            <input type="hidden" name="school_code" value="{{Auth::user()->school_code }}">
                            <input type="hidden" name="msg_id" value="{{ rand(0, 10000) }}">
                          @endif
                          
                          <div class="form-group row">
                            <label class="col-sm-3 col-md-2 col-form-label text-right">Subject :</label>
                            <div class="col-sm-9 col-md-10">
                              <input class="form-control" type="text" name="subject" id="subject" required="">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label class="col-sm-3 col-md-2 col-form-label text-right">Message :</label>
                            <div class="col-sm-9 col-md-10">
                              <textarea cols="500" class="form-control" name="message">
                                
                              </textarea>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-3 col-md-2 col-form-label text-right">Attachement (Optional) :</label>
                            <div class="col-sm-9 col-md-10">
                              <input class="form-control" type="file" name="attachment">
                            </div>
                          </div>

                          <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-success">SEND</button>
                          </div>
                        </form>
                      </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<script type="text/javascript">
  $('#search').on('keyup',function(){
    $value=$(this).val();
    $.ajax({
      type : "post",
      url :  "{{ url('/search') }}",
      data:{
        'search':$value
      },
      success:function(data){
        $('#keyput').html(data);
      }
    });
  })
</script>

<script type="text/javascript">
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script type="text/javascript">
  $.ajax({
    url: "//your AJAX route",
    type: "post", //send it through post method
    data: { 
      //send your data here 
    },
    success: function(response) {
      console.log(response); // Your response.
    },
    error: function(xhr) {
      console.log("ERROR"+xhr); // Debug errors.
    }
  });
</script>
@endsection