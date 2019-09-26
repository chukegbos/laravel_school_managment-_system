@extends('layouts.admin')
@section('pageTitle', 'Support')
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
                      <div><i class="fa fa-mail-forward"></i> <small>Mailbox</small></div>
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
                          <h6>Mailbox</h6>
                          <ul class="nav">
                            <li class="active">
                              <a href="{{ url('/admin/mail') }}"><i class="fa fa-inbox"></i>Inbox <small class="label pull-right bg-green">{{ $countmail }}</small></a>
                            </li>
                            <li><a href="{{ url('/admin/compose') }}"><i class="fa fa-envelope-o"></i>Send Mail</a></li>
                             <li><a href="{{ url('/admin/sentmail') }}"><i class="fa fa-file-text-o"></i>Sent</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
              @if(isset($msg))
                <div class="col-xs-12 col-sm-12 col-md-9 p-0 inbox-mail">
                    <div class="inbox-avatar p-20 border-btm">
                        <img src="assets/dist/img/avatar5.png" class="border-green hidden-xs hidden-sm" alt="">
                        <div class="inbox-avatar-text">
                            <div class="avatar-name"><strong>From: </strong>
                                {{ $msg->from }}<em></em>
                            </div>
                            <div class="avatar-name"><strong>To: </strong>
                                {{ $msg->to }}<em></em>
                            </div>
                            <div><small><strong>Subject: </strong> {{ $msg->subject }}</small></div>
                        </div>
                        <div class="inbox-date text-right hidden-xs hidden-sm">
                            <div><span class="bg-green badge"><small>MSG ID: {{ $msg->msg_id }}</small></span></div>
                            <div><small>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($msg->created_at))->toFormattedDateString() }}</small></div>
                        </div>
                    </div>
                    <div class="inbox-mail-details p-20">
                        <p>{{ $msg->message }}</p>
                        <div class="row">
                          @if(isset($msg->attachment))
                            <div class="col-sm-2 col-xs-4">
                              <a href="{{ asset('storage') }}/{{ $msg->attachment }}">
                                <img class="img-thumbnail img-responsive" alt="Attachment" src="{{ asset('storage') }}/{{ $msg->attachment }}"> 
                              </a>
                            </div>
                          @endif
                        </div>
                        <div class="m-t-20 border-all p-20">
                            <p class="p-b-20">click here to <a href="{{ url('/admin/compose') }}">Reply</a></p>
                        </div> 
                    </div>
                </div>
              @else
                <div class="col-xs-12 col-sm-12 col-md-9 p-0 inbox-mail">
                <div class="mailbox-content">
                  @forelse($mails as $mail)
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
                  @empty
                    <div class="inbox-avatar-text">
                      <p style="padding: 20px; color: {{ $setting->color  }}">Inbox is Empty</p>
                    </div>
                  @endforelse
                </div>
                <div class="pagination">
                  {{ $mails->links() }}
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection