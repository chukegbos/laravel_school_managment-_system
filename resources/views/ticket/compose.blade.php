@extends('layouts.admin')
@section('pageTitle', 'Open Ticket')
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
                                  <div class="btn-group">
                                      <a href="#" class="btn btn-default"><span class="fa fa-reply"></span> Reply</a>
                                      <a href="#" class="hidden-xs hidden-sm btn btn-default"><span class="fa fa-reply-all"></span> Reply All</a>
                                      <a href="#" class="btn btn-default"><span class="fa fa-share"></span> Forward</a>
                                  </div>
                                  <div class="hidden-xs hidden-sm btn-group">
                                      <button type="button" class="text-center btn btn-danger"><span class="fa fa-exclamation"></span></button>
                                      <button type="button" class="btn btn-danger"><span class="fa fa-trash"></span></button>
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
                                          <li class="active"><a href="#"><i class="fa fa-inbox"></i>Inbox <small class="label pull-right bg-green">61</small></a></li>
                                          <li><a href="#"><i class="fa fa-envelope-o"></i>Send Mail</a></li>
                                          <li><a href="#"><i class="fa fa-star-o"></i>Starred</a></li>
                                          <li><a href="#"><i class="fa fa-trash-o"></i>Tresh </a></li>
                                          <li><a href="#"><i class="fa fa-paperclip"></i>Attachments</a></li>
                                      </ul>
                                      <h6>Other</h6>
                                      <ul class="nav">
                                          <li><a href="#"><i class="fa fa-exclamation"></i>Spam</a></li>
                                          <li><a href="#"><i class="fa fa-file-text-o"></i>Draft</a></li>
                                      </ul>
                                      <h6>Tags</h6>
                                      <ul class="nav">
                                          <li><a href="#"><i class="fa fa-circle color-green"></i>#sometag</a></li>
                                          <li><a href="#"><i class="fa fa-circle color-red"></i>#anothertag</a></li>
                                          <li><a href="#"><i class="fa fa-circle color-yellow"></i>#anotheronetag</a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>

                          <div class="col-xs-12 col-sm-12 col-md-9 p-0 inbox-mail p-20">
                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label text-right">To :</label>
                                <div class="col-sm-9 col-md-10">
                                    <input class="form-control" type="text"  id="to">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label text-right">Cc :</label>
                                <div class="col-sm-9 col-md-10">
                                    <input class="form-control" type="text" id="cc">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-md-2 col-form-label text-right">Subject :</label>
                                <div class="col-sm-9 col-md-10">
                                    <input class="form-control" type="text" id="subjejct">
                                </div>
                            </div>
                            <!-- summernote -->
                            <div id="summernote" style="width: 737px"></div>
                            <div class="hidden-xs hidden-sm btn-group">
                                <button type="button" class="text-center btn btn-default">DISCARD</button>
                                <button type="button" class="btn btn-default">SAVE</button>
                            </div>
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-success">SEND</button>
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