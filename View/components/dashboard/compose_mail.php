 <!-- Modal -->
                          <div class="modal fade" id="modalComposeMail" tabindex="-1" role="dialog" aria-labelledby="modalComposeMailLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          <h4 class="modal-title">Compose</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form class="form-horizontal" role="form" id="compose_message">
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">To</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" class="form-control search_member" name="email" placeholder="">
                                                  </div>
                                              </div>
<!--                                              <div class="form-group">-->
<!--                                                  <label class="col-lg-2 control-label">Cc / Bcc</label>-->
<!--                                                  <div class="col-lg-10">-->
<!--                                                      <input type="text" class="form-control" id="cc" placeholder="">-->
<!--                                                  </div>-->
<!--                                              </div>-->
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Subject</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" class="form-control" name="objet" placeholder="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Message</label>
                                                  <div class="col-lg-10">
                                                      <textarea name="message" class="form-control" cols="30" rows="10"></textarea>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
<!--                                                      <span class="btn green fileinput-button">-->
<!--                                                        <i class="icon-plus icon-white"></i>-->
<!--                                                        <span>Attachment</span>-->
<!--                                                        <input type="file" multiple="" name="files[]">-->
<!--                                                      </span>-->
                                                      <button type="submit" class="btn btn-send">Send</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->