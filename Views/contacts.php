<!DOCTYPE html>
<html lang="en">

<?php include 'layouts/head.php' ?>

<link rel="stylesheet" href="assets/web/css/contact.css">

<body>
    <?php include 'layouts/sidebar.php' ?>
    <hr />
    <section class="container">
        <div class="btns">
            <a href="/" class="btn">Home</a>
            <a href="work" class="btn">Work</a>
            <a href="amazon" class="btn">Amazon</a>
        </div>
    </section>

    <main class="container">

        <?php if ($user->level_id > 1 and $user->level_id < 5) { ?>
            <div class="desc" style="margin-bottom:10px;">
                <center style="font-size:20px;font-weight:bold;">
                    معزز صارف آپ کو ایما ڈوکس کی اپ ڈیٹ کے لئے نیچے ایک گروپ کا لنک دیا ہے جو کہ ایما ڈوکس کے ایک کسٹمر کے
                    گروپ کا لنک ہے جس میں آپ کو روزانہ مختلف اپ ڈیٹس ملیں گی آپ کو کام کرنے میں کوئی بھی پریشانی ہو تو آپ
                    اپنے ٹیم لیڈر سے رابطہ کریں جس نے آپ کو ایما ڈوکس پر جوائن کروایا اگر آپ کا لیڈر آپ کو رسپونس نہیں دیتا
                    تو آپ ہماری ای میل پر اس کا نام نمبر اور جس لنک سے جوائن کیا وہ لنک سینڈ کریں تا کہ اس لیڈر پر ایکشن لیا
                    جا سکے یاد رہے کہ آپ ای میل پر صرف اپنے لیڈر کی شکایت کر سکتے ہیں باقی تمام مسائل آپ کے یا آپ کی ٹیم کے
                    ہوں وہ آپ اپنے لیڈر کو ہی بتائیں گے شکریہ
                    helpcenter.amadox@gmail.com
                </center>
                </p>
            </div>
            <div class="contact text-center" style="margin-top:10px;margin-bottom:10px;">
                <a href="<?= $settings->whatsapp_link ?>"><button class="btn">Whatsapp</button></a>
            </div>
        <?php } ?>

        <div class="desc">
            <center style="font-size:20px;font-weight:bold">
                In case of any problem in working on Amadox, you can contact our official email.
                To file a complaint, send your email, description of the complaint and required screen shot only once.
                In case of no response with in 4 hours.Please contact again.Repeatedly filing the same complaint or
                incomplete complaint details will not resolve your issue.<br>
                Thank you.</center>
            </p>
        </div>
        <div class="contact text-center">
            <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?= $settings->email ?>&body=my-text"><button class="btn">Email</button></a>
            <button class="btn">Whatsapp</button>
        </div>
    </main>
</body>

</html>