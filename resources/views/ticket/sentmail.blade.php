@extends('layouts.admin')
@section('pageTitle', 'Sent Mail')
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
                      <div><i class="fa fa-mail-forward"></i> <small>Sent Message</small></div>
                    </div>
                </div>
              </div>

              <div class="col-xs-8">
                <div class="inbox-toolbar btn-toolbar">
                  <div class="btn-group">
                    <a href="{{ url('admin/compose') }}" class="btn btn-success"><span class="fa fa-pencil-square-o"></span> Compose</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mailbox-body">
            <div class="row m-0">
              <div class="col-sm-3 p-0 inbox-nav hidden-xs hidden-sm">
                <div class="mailbox-sideber">
                  <div class="profile-usermenu">
                    <h6>Sent Mail</h6>
                    <ul class="nav">
                      <li><a href="{{ url('/admin/mail') }}"><i class="fa fa-inbox"></i>Inbox <small class="label pull-right bg-green">{{ $countmail }}</small></a></li>
                      <li><a href="{{ url('/admin/compose') }}"><i class="fa fa-envelope-o"></i>Send Mail</a></li>
                       <li class="active"><a href="{{ url('/admin/sentmail') }}"><i class="fa fa-file-text-o"></i>Sent</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-9 p-0 inbox-mail">
                <div class="mailbox-content">
                  @forelse($mails as $mail)
                    @if((Auth::user()->role=="Sales Rep") || (Auth::user()->role=="Marketer"))
                      @forelse($schools as $school)
                        @if($school->school_code==$mail->to)
                          <a href="{{ url('admin/readmail') }}/?msg_id={{$mail->msg_id}}" class="inbox_item unread">
                            <div class="row">
                              <div class="col-md-1">
                              </div>
                            
                              <div class="col-md-11">
                                <div class="inbox-avatar">
                                  <img src="{{ asset('storage') }}/{{ $setting->logo }}" class="border-green hidden-xs hidden-sm" alt="">
                                  
                                  <div class="inbox-avatar-text">
                                    <div class="avatar-name">{{ $mail->name }}</div>
                                    <div>
                                      <small>
                                        <span class="bg-green badge avatar-text">MSG ID: {{ $mail->msg_id }}</span>
                                        <span>
                                          <strong>{{ $mail->subject }}: </strong>
                                        </span>
                                      </small>
                                    </div>
                                    
                                  </div>
                                  <div class="inbox-date hidden-sm hidden-xs hidden-md" style="color: black">
                                    <strong>Date Sent</strong>
                                    <div class="date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($mail->created_at))->toFormattedDateString() }}</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </a>
                        @endif
                      @empty
                      @endforelse
                    @else
                      <a href="{{ url('admin/readmail') }}/?msg_id={{$mail->msg_id}}" class="inbox_item unread">
                        <div class="row">
                          <div class="col-md-1">
                          </div>
                        
                          <div class="col-md-11">
                            <div class="inbox-avatar">
                              <img src="{{ asset('storage') }}/{{ $setting->logo }}" class="border-green hidden-xs hidden-sm" alt="">
                              
                              <div class="inbox-avatar-text">
                                <div class="avatar-name">{{ $mail->name }}</div>
                                <div>
                                  <small>
                                    <span class="bg-green badge avatar-text">MSG ID: {{ $mail->msg_id }}</span>
                                    <span>
                                      <strong>{{ $mail->subject }}: </strong>
                                    </span>
                                  </small>
                                </div>
                                
                              </div>
                              <div class="inbox-date hidden-sm hidden-xs hidden-md" style="color: black">
                                <strong>Date Sent</strong>
                                <div class="date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($mail->created_at))->toFormattedDateString() }}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </a>
                    @endif
                  @empty
                    <div class="inbox-avatar-text">
                      <p style="padding: 20px; color: {{ $setting->color  }}">Sent Mail is Empty</p>
                    </div>
                  @endforelse
                </div>
                <div class="pagination">
                  {{ $mails->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection