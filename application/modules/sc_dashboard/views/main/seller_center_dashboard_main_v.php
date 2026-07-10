<div id="pengaturan_toko_content" class="col-md-9 p-3 pr-5">
    <div class="title-text m-0"><i class="fa fa-home m-0"></i> Dashboard</div>
    <div class="row">
      <div class="col-7">
        <div class="card mt-3">
          <div class="card-header" style="background-color:#FFFFFF">
            <h6 style="margin-bottom:0px;">Rekapitulasi Toko</h6>
            <p style="margin-bottom:0px;">Rekapitulasi tokomu</p>
          </div>
              <div class="card-body p-0">
                <div class="row ml-0 mr-0">
                    <div onClick="location.href='<?php echo base_url();?>my-store/transaction?showPending=true'" class="col-6 recap" style="padding-left:1.25rem;border-right:1px solid rgba(0,0,0,.125);border-bottom:1px solid rgba(0,0,0,.125);">
                        <font style="color:rgb(108, 114, 124);font-size:13px">Pesanan Baru</font>
                        <h2><?php echo $count['transPending']; ?></h2>
                    </div>
                    <div onClick="location.href='<?php echo base_url();?>my-store/transaction?showProcess=true'" class="col-6 recap" style="padding-left:1.25rem;border-bottom:1px solid rgba(0,0,0,.125);">
                        <font style="color:rgb(108, 114, 124);font-size:13px">Pesanan Sedang Diproses</font>
                        <h2><?php echo $count['transProcess']; ?></h2>
                    </div>
                    <div onClick="location.href='<?php echo base_url();?>my-store/transaction?showSent=true'" class="col-6 recap" style="padding-left:1.25rem;border-right:1px solid rgba(0,0,0,.125);">
                        <font style="color:rgb(108, 114, 124);font-size:13px">Pesanan Sedang Dikirim</font>
                        <h2><?php echo $count['transSend']; ?></h2>
                    </div>
                    <div class="col-6 recap" style="padding-left:1.25rem;">
                        <font style="color:rgb(108, 114, 124);font-size:13px">Komplain Pesanan</font>
                        <h2>0</h2>
                    </div>
                </div>
              </div>
            </div>
          </div>
      <div class="col-5">
        <div class="card mt-3">
          <div class="card-header" style="background-color:#FFFFFF">
            <h6 style="margin-bottom:0px;">Performa Penjualan</h6>
            <p style="margin-bottom:0px;">Jaga performa tokomu</p>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="pl-4 pr-4 pt-2 pb-2">
                  <svg
                    class="progress-ring"
                    width="120"
                    height="120">
                      <circle
                        class="progress-ring__circle"
                        stroke="grey"
                        stroke-width="6"
                        fill="transparent"
                        r="52"
                        cx="60"
                        cy="60"/>
                      <circle
                        id="circleBar"
                        class="progress-ring__circle"
                        stroke="green"
                        stroke-width="6"
                        fill="transparent"
                        r="52"
                        cx="60"
                        cy="60"/>
                      <text x="50%" y="50%" text-anchor="middle" stroke="black" stroke-width="1px" dy=".3em"  font-size="1.3rem" id="feedbackPercentage"><?php $storeFeedbackCount==0?$feedbackDiv=1:$feedbackDiv=$storeFeedbackCount; echo number_format(($storeFeedbackCountPositive/$feedbackDiv)*100,0,'.',','); ?>%</text>
                  </svg>
                </div>
                <div class="store-row-container">
                  <div>
                    <div>
                      <div>Feedback Positif</div>
                      <div><b><?php echo $storeFeedbackCountPositive;?></b></div>
                    </div>
                    <div class="mt-2">
                      <div>Feedback Negatif</div>
                      <div><b><?php echo $storeFeedbackCountNegative;?></b></div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>

            <div class="col-9">
              <div class="card mt-3">
                <div class="card-header" style="background-color:#FFFFFF">
                  <h6 style="margin-bottom:0px;">Rekapitulasi Penjualan</h6>
                  <p style="margin-bottom:0px;">Rekapitulasi Penjualan selama 7 hari terakhir</p>
                </div>
                    <div class="card-body">
                      <div class="row pl-4 pr-4 pt-2 pb-2">
                        <canvas id="sales7day"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-3">
                  <div class="card mt-3">
                    <div class="card-header" style="background-color:#FFFFFF">
                      <h6 style="margin-bottom:0px;">Statistik Toko</h6>
                      <p style="margin-bottom:0px;">Statistik tokomu</p>
                    </div>
                        <div class="card-body">

                          <div class="row pl-3 pr-3 pt-1 pb-1">
                            <div>
                              <div>Rata-rata waktu kirim</div>
                              <div><b><?php echo $storeAverageSentTime;?></b></div>
                            </div>
                            <div class="mt-2">
                              <div>Jumlah Pelanggan</div>
                              <div><b><?php echo $storeFollowersCount;?></b></div>
                            </div>
                            <div class="mt-2">
                              <div>Jumlah Produk Terjual</div>
                              <div><b><?php echo $this->numberingModel->integerSeparation(',',0,$count['countProductSold']);?> pc(s)</b></div>
                            </div>
                            <div class="mt-2">
                              <div>Total Penjualan</div>
                              <div><b><?php echo $this->currencyModel->integerToCurrency('rupiah',$count['amountProductSold']);?></b></div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
          </div>
      </div>
  </div>
</div>
