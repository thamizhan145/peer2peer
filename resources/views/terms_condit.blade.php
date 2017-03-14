@extends('layouts.app')

@section('content')

<div class="main-box">
         <div class="box-cover main-box-cover">
            <h1>&nbsp;</h1>
            <h1>&nbsp;</h1>
            <h1>&nbsp;</h1>
         </div>
</div>
    
    <div class="features">
         <div class="container-fluid">
            <div class="row">
               <div class="col col-sm-12" style="text-align: justify;">
                  <h4>About 1 Help Zone (1Hz)</h4>
                  <p class="justify">1 Help zone is a community of people willing and able to help people. We have a common goal of helping humanity. it is not a bank, it is not a corporative society, it is just a meeting point for well-meaning individuals expressing their willingness to help other people. We have no central account, so participant pays directly into other participant’s bank account without any conditions, Promises or guarantees.</p>
                  <br>
                  <p>No Lender, No investor and no Guaranty, your money is not growing because we are not investing your money, rather your money qualifies you to get help from other people in a multiples of your donated help.</p>
                  <br>
                  <p>This community is not made up of houses, cars and businesses or legal entities rather it is made up of ordinary people loving and caring for each other. Therefore, the survival of this community is on your hand. You may say I have seen many of such systems, yes, but we are with a difference, the lifespan of this system remains as long as you continue to perform your obligation faitfully.</p>
                </div>
            </div>
        </div>
    </div>

    </div>


    <div class="post">
         <div class="container-fluid">
            <div class="row get-post">
               <div class="col col-md-6">
                  <img src="images/ipad.png" alt="img">
               </div>
               <div class="col col-md-6">
                  <h2 class="title">IMPORTANT!</h2>
                        
                        <h3>
                     Be sure that all payments has been confirmed before allowing person to provide help or get help.
                     <br><br>
There should be a warning before confirmation of payment. (This action you want to perform is irreversible! Please be sure that you have received the payment)
</h3>
               </div>
            </div>
         </div>
      </div>
      <hr class="st-hr container">
      <div class="faq">
         <div style="background: #fff;" class="container-fluid">
            <div class="row" style="text-align: justify;">
               <div class="col-md-12">
                  <div class="item">
                     <h4 class="title">How It Works</h4>
                     <p>If you know you are willing to help someone, then create and Account by clicking on “Create account” link on the main page. After signing up, then login into your dashboard and click on “Account” and update your bank account information. After that you are good to go.</p>
                     <p>We have a single regime of N25, 000.00 meaning we only accept one amount which is 25k. Click on “Provide help” and accept terms and conditions, after that wait for you to be matched to another participant which you will pay. When you are matched, Click on the Participant’s name to reveal his/her bank details, make payment by Paying directly to the participant’s account using Mobile or Online transfer. Then upload your proof of payment contact the participant to let him/her know that you have paid money to his/her account.</p>
                     <p>
                        After the payment has been confirmed, you will then be eligible to get help. To get help, Click on “Get Help” link on your dashboard, and accept the terms and condition, then wait for other 2 participants to be matched to pay you N25,000.00 each making it a total of N50,000.00. Make sure you confirm the receipt of the payments as soon as the payment is made.
                     </p>
                     <p class="alert alert-warning">
                        NOTE: you are expected to make payment within 24hrs after you have been paired to provide help.
                     </p>
                  </div>
               </div>

            </div>
         </div>


         <div style="background: #fff;" class="container-fluid">
            <div class="row" style="text-align: justify;">
               <div class="col-md-12">
                  <div class="item">
                     <h4 class="title">Referrals Bonuses</h4>
                     <p>We believe in reward for labour that is why we set a reward mechanism for those that really work and make sure that this community continues to grow. For every participant you referred to the community, you are entitled to a one-time N5, 000.00 when the person provides help and pays his pledge. This referrals bonuses is withdrawable in multiple of 5. That is you can only withdraw your bonuses when you have 5 people under you that have provided help and payed their pledges. 

                     </p>
                     <p class="alert alert-info">
                     NOTE: You cannot withdraw referral bonuses alone, you must withdraw it along with you get help amount. Meaning that when withdrawing referral bonuses, you will get help of N75, 000.00. instead of N50,000.00.
                     </p>
                  </div>
               </div>

            </div>
         </div>


      <div style="background: #fff;" class="container-fluid">
            <div class="row" style="text-align: justify;">
               <div class="col-md-12">
                  <div class="item">
                     <h4 class="title">Penalties</h4>
                     
                     <p class="alert alert-warning">

1. If you fail to make your payment within 24 hrs, your account will be blocked and all your Referrals permanently removed from your account.
<br>
2. If you upload fake Proof of Payment, Your account will be deleted from our system.
                     
                     </p>
                  </div>
               </div>

            </div>
         </div>

      </div>

      <div class="contact">
         <center>
            <a href="/register" class="btn btn-primary">Create Your Account</a> &nbsp;&nbsp;&nbsp;
            <a href="/login" class="btn btn-primary">Sign In</a>
         </center>
      </div>
      <div id="footer">
         <p>1HelpZone - 2017 All right reserved</p>
      </div>


@endsection