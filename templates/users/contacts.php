<?php include __DIR__ . '/../header.php'; ?>


 <h1>Контакты</h1>
 <hr>
 <p>Свяжитесь со мной любым удобным для вас способом: </p>
<div class="contacts_social">
    <a href="https://t.me/karabasov_anton" class="contacts_link" target="_blank">
        <svg class="telegram" width="30" height="30" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve"  style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><path id="telegram-3" d="M19,24l-14,0c-2.761,0 -5,-2.239 -5,-5l0,-14c0,-2.761 2.239,-5 5,-5l14,0c2.762,0 5,2.239 5,5l0,14c0,2.761 -2.238,5 -5,5Zm-2.744,-5.148c0.215,0.153 0.491,0.191 0.738,0.097c0.246,-0.093 0.428,-0.304 0.483,-0.56c0.579,-2.722 1.985,-9.614 2.512,-12.09c0.039,-0.187 -0.027,-0.381 -0.173,-0.506c-0.147,-0.124 -0.351,-0.16 -0.532,-0.093c-2.795,1.034 -11.404,4.264 -14.923,5.567c-0.223,0.082 -0.368,0.297 -0.361,0.533c0.008,0.235 0.167,0.44 0.395,0.509c1.578,0.471 3.65,1.128 3.65,1.128c0,0 0.967,2.924 1.472,4.41c0.063,0.187 0.21,0.334 0.402,0.384c0.193,0.05 0.397,-0.002 0.541,-0.138c0.811,-0.765 2.064,-1.948 2.064,-1.948c0,0 2.381,1.746 3.732,2.707Zm-7.34,-5.784l1.119,3.692l0.249,-2.338c0,0 4.324,-3.9 6.79,-6.124c0.072,-0.065 0.082,-0.174 0.022,-0.251c-0.06,-0.077 -0.169,-0.095 -0.251,-0.043c-2.857,1.825 -7.929,5.064 -7.929,5.064Z" fill="#000"/></svg>
    </a>
    <a href="https://vk.com/id37222300" class="contacts_link" target="_blank">
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 96 96" style="enable-background:new 0 0 96 96;" xml:space="preserve" width="30" height="30"><path fill="#000000" d="M53.174,52.908c-1.539-0.896-3.678-0.896-5.416-0.896h-5.707v11.76h5.238
                                        c1.939,0,4.412,0.139,6.084-1.035c1.535-1.033,2.404-3.061,2.404-4.992C55.777,55.951,54.709,53.805,53.174,52.908z M51.021,42.865
                                        c1.27-0.967,1.936-2.691,1.936-4.279c0-1.725-0.801-3.381-2.27-4.277c-1.537-0.896-4.346-0.689-6.15-0.689h-2.486v10.35h3.289
                                        C47.211,43.969,49.418,44.107,51.021,42.865z M79.125,0H16.873C7.555,0,0,7.555,0,16.875v62.25C0,88.443,7.555,96,16.873,96h62.252
                                        C88.443,96,96,88.443,96,79.125v-64.25C96,7.555,88.443,0,79.125,0z M50.604,72.535H30.992V25.201H52.42
                                        c6.207,0,11.934,3.951,11.934,10.92c0,5.381-3.004,9.066-6.836,10.211v0.139c5.682,1.174,9.74,4.26,9.74,11.705
                                        C67.258,65.066,62.566,72.535,50.604,72.535z"/>
                                </svg>
    </a>
</div>
<br>
<p>Или отправьте ваше сообщение здесь:</p>
 <form action="/contacts" method="post">
      <div class="form-group">
          <textarea class="form-control" id="textarea" name="text"  rows="10" cols="100" required></textarea></label>
      </div>
      <button class="btn btn-lg btn-success pull-right">отправить</button>
 </form>

 <div class="margin-8 clear"></div>

<?php include __DIR__ . '/../footer.php'; ?>