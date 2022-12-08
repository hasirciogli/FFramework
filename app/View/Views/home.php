<div class="w-full h-screen flex flex-col">
    <div class="container h-[40px] md:h-[50px] mx-auto">
        <!----><div class="flex h-full flex-row text-xl md:text-2xl float-left items-center font-extrabold antialised pl-3">
            <span class="text-blue-900">HSRC</span>
            <span class="text-blue-700 ml-1">Pay</span>
        </div>

        <div class="flex float-left h-full items-center text-gray-500 font-bold hidden sm:flex">
            <a href="#why-us"       class="ml-4 hover:text-blue-700 duration-200 ease-in-out hover:underline">Why us?</a>
            <a href="#who-us"  class="ml-4 hover:text-blue-700 duration-200 ease-in-out hover:underline">About us</a>
        </div>
        <div class="flex h-full flex-row float-right font-light items-center">
            <?php if (\AuthController\AuthController::isLogged()) { ?>

                <div class="login mr-3 text-lg font-semibold text-slate-400 hover:text-blue-700 duration-200 ease-in-out">
                    <a href="/dashboard">Dashboard</a>
                </div>

                <?php
            }
            else{
                ?>
                <div class="login mr-3 font-semibold text-slate-400 hover:text-blue-700 duration-200 ease-out">
                    <a href="/login">Login</a>
                </div>

                <div class="register mr-3 font-semibold text-slate-400 hover:text-blue-700 duration-200 ease-out">
                    <a href="/register">Register</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>


    <div class="container mx-auto h-full flex flex-col items-center justify-center rounded mt-3">

        <div class="flex flex-col w-full justify-center">
            <div class="w-full h-[60px] flex items-center justify-center text-2xl md:text-4xl text-blue-700 font-extrabold">PAYMENT <span class="text-blue-900 ml-2">CHANNELS</span></div>
            <div class="w-full h-[30px] text-sm md:text-md text-blue-500 font-semibold mt-2 text-center">You can receive payments from anywhere such as Instagram, Twitter, Facebook, Whatsapp and your Website!</div>
        </div>

        <div class="flex flex-col md:flex-row w-full items-center justify-center mt-7 sm:mt-10 md:mt-10 flex-wrap">
            <div class="flex flex-row">
                <i class="fa-brands fa-facebook text-7xl text-[#4267B2] m-3 animason-yuvarlan"></i>
                <i class="fa-brands fa-instagram text-7xl bg-clip-text text-transparent bg-gradient-to-br from-[#405DE6] via-red-700 to-[#FFDC80] m-3 animason-yuvarlan"></i>
                <i class="fa-brands fa-facebook-messenger text-7xl bg-clip-text text-transparent bg-gradient-to-br from-red-800 to-[#006AFF] m-3 animason-yuvarlan"></i>
            </div>

            <div class="flex flex-row items-center justify-center mt-2 md:mt-0">
                <i class="fa-brands fa-whatsapp text-7xl text-[#25D366] m-3 animason-yuvarlan"></i>
                <i class="fa-brands fa-twitter text-7xl bg-clip-text text-transparent bg-gradient-to-tr from-blue-900 to-[#00acee] m-3 animason-yuvarlan"></i>
                <i class="fa-solid fa-comment-sms text-7xl bg-clip-text text-transparent bg-gradient-to-tl from-green-500 to-blue-300 m-3 animason-yuvarlan"></i>
            </div>

            <div class="flex flex-row items-center justify-center mt-2 md:mt-0">
                <i class="fa-solid fa-envelope text-7xl bg-clip-text text-transparent bg-gradient-to-b from-red-600 to-red-700 m-3 animason-yuvarlan"></i>
                <i class="fa-solid fa-sitemap text-7xl text-blue-600 m-3 animason-yuvarlan"></i>
                <span class="font-semibold text-3xl md:text-5xl text-blue-600 m-3 animason-yuvarlan">+99</span>
            </div>
        </div>
    </div>
</div>














<div class="w-full min-h-screen flex flex-col mb-10">
    <div class="container mx-auto my-3 p-3 flex flex-col" id="why-us">
        <div class="w-full flex item-center md:justify-center ml-2 md:ml-0 md:mt-10 min-h-10 text-4xl font-bold">
            <span class="text-blue-600">WHY</span>
            <span class="text-blue-800 ml-2 mr-2">US</span>
            ?
        </div>

        <div class="w-full flex item-center md:justify-center ml-3 md:ml-0 md:mb-10 min-h-10 text-sm font-bold">
            <span class="text-blue-500">Why Not ? :)</span>
        </div>
    </div>
    <div class="container mx-auto flex flex-col md:flex-row min-h-[1200px] md:min-h-[400px] md:p-3">



        <div class="w-full flex p-3 md:p-0 md:px-2 h-[400px] md:h-[350px] overflow-hidden">
            <div class="flex w-full h-full rounded-md flex-col overflow-hidden shadow-lg shadow-slate-300 border border-slate-300">
                <div class="flex flex-col w-full items-center justify-center mb-5">
                    <i class="fa-solid fa-user-shield mt-10 text-blue-600 text-8xl"></i>
                    <span class="mt-5 font-semibold text-xl">
                        <span class="text-blue-700 font-bold">3DS</span> Secure Payment System
                    </span>
                </div>

                <div class="flex flex-col w-full items-center justify-center h-full bg-blue-500 text-center text-white p-3">
                    Transactions that are not secure with 3DS are canceled. We are improving our artificial intelligence day by day in order to serve with a completely secure system.
                </div>
            </div>
        </div>



        <div class="w-full flex p-3 md:p-0 md:px-2 h-[400px] md:h-[350px] overflow-hidden">
            <div class="flex w-full h-full rounded-md flex-col overflow-hidden shadow-lg shadow-slate-300 border border-slate-300">
                <div class="flex flex-col w-full items-center justify-center mb-5">
                    <i class="fa-solid fa-hand-holding-dollar mt-10 text-blue-600 text-8xl"></i>
                    <span class="mt-5 font-semibold text-xl">
                        <span class="text-blue-700 font-bold">LOW</span> Interruption
                    </span>
                </div>

                <div class="flex flex-col w-full items-center justify-center h-full bg-blue-500 text-center text-white p-3">
                    2.99% and 0.29 TL per successful transaction are deducted
                </div>
            </div>
        </div>



        <div class="w-full flex p-3 md:p-0 md:px-2 h-[400px] md:h-[350px] overflow-hidden">
            <div class="flex w-full h-full rounded-md flex-col overflow-hidden shadow-lg shadow-slate-300 border border-slate-300">
                <div class="flex flex-col w-full items-center justify-center mb-5">
                    <i class="fa-solid fa-circle-check mt-10 text-blue-600 text-8xl"></i>
                    <span class="mt-5 font-semibold text-xl">
                        <span class="text-blue-700 font-bold">2</span> Minute After Get First Money
                    </span>
                </div>

                <div class="flex flex-col w-full items-center justify-center h-full bg-blue-500 text-center text-white p-3">
                    Create your account. Confirm your e-mail address. Indicate your website to the site. If you're not going to get paid with the link, check out our github page. And start getting paid!
                </div>
            </div>
        </div>



    </div>
</div>




<div class="w-full my-10">
    <div class="container mx-auto flex flex-col px-3 md:px-0 md:flex-row min-h-screen md:h-screen items-center mb-[80px] pb-5 md:mb-[0px] md:pb-0">
        <div class="w-full flex items-center justify-center h-[400px] mb-[60px] md:mb-0">
            <div class="w-full md:w-9/12">
                <h1 class="text-3xl w-full text-center font-bold text-blue-700">Simple checkout page</h1>
                <p class="w-full px-2 md:px-5 mt-3 md:mt-5 text-lg text-center">
                    User-friendly payment interface.
                    Except for a few, we do not ask for Customer information. Our goal is for you to collect your fee. Just take your payment and then deliver the product.
                </p>
            </div>
        </div>
        <div class="w-full flex items-center justify-center">
            <div class="w-full flex flex-col md:w-[400px] bg-white rounded-lg shadow-lg shdow-slate-300 p-3">
                <div class="w-[100px] h-[100px] rounded-full bg-blue-600 text-white flex items-center justify-center font-bold mx-auto relative top-[-63px] text-5xl">
                    <i class="fa-brands fa-cc-visa"></i>
                </div>
                <form action="" method="post" class="flex flex-col mt-[-20px]">
                    <label for="ccname" class="text-gray-700 font-bold text-sm">Credit Card Holder Name:</label>
                    <input id="ccname" type="text" inputmode="text" autocomplete="cc-name" maxlength="45" placeholder="xxxx xxxx" class="rounded-md mb-4" name="cc_name">


                    <label for="ccnumber" class="text-gray-700 font-bold text-sm">Credit Card Number:</label>
                    <input id="ccnumber" type="text" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx" class="rounded-md mb-4" name="cc_number">

                    <div class="w-full flex flex-row mb-5">
                        <div class="item flex flex-col w-4/12">
                            <label class="text-gray-700 font-bold text-sm">CC Month</label>
                            <input id="cc-month" type="text" autocomplete="cc-month" maxlength="2" placeholder="xx" class="rounded-md text-center" name="cc_month">
                        </div>

                        <div class="item flex flex-col w-4/12 ml-2">
                            <label class="text-gray-700 font-bold text-sm">CC Year</label>
                            <input id="cc-year" type="text" autocomplete="cc-year" maxlength="2" placeholder="xx" class="rounded-md text-center" name="cc_year">
                        </div>

                        <div class="item flex flex-col w-2/12 ml-auto">
                            <label class="text-gray-700 font-bold text-sm">CC CVV</label>
                            <input id="cc-cvv" type="text" autocomplete="cc-cvv" maxlength="3" placeholder="xxx" class="rounded-md text-center" name="cc_cvv">
                        </div>
                    </div>

                    <input type="submit" value="DONATE 18$" class="w-full rounded-lg bg-blue-600 duration-300 h-[50px] text-xl font-bold text-white hover:bg-blue-800 hover:cursor-pointer">
                </form>
            </div>
        </div>
    </div>
</div>








<div class="w-full min-h-screen flex items-center justify-center mb-[50px] mt-[150px] md:my-0 px-3 md:px-0" id="who-us">

    <div class="container mx-auto min-h-[600px] sm:min-h-[400px] bg-white rounded-md shadow-lg duration-200 ease-in-out shadow-[0px_0px_10px_1px_rgba(0,0,0,0.2)] sm:shadow-[0px_0px_50px_2px_rgba(0,0,0,0.1)] sm:hover:shadow-[0px_0px_10px_1px_rgba(0,0,0,0.2)]">

        <div class="relative w-full flex justify-center flex h-[82.5px] relative">
            <div class="w-auto flex flex-row justify-center h-[165px] absolute top-[-82.5px]">
                <img src="./storage/site-images/home-about-us-owner.jpg" class="w-[150px] h-[150px] relative rounded-full z-[50] top-[7.5px]">
                <div class="rounded-full w-[155px] h-[155px] bg-red-600 absolute z-[45] top-[5px]"></div>
                <div class="rounded-full w-[160px] h-[160px] bg-blue-600 absolute z-[40] top-[2.5px]"></div>
                <div class="rounded-full w-[165px] h-[165px] bg-green-600 absolute z-[35]"></div>
            </div>
        </div>

        <div class="w-full h-10 bg-blue-600 mt-3 flex items-center justify-center">
            <!--<h1 class="text-2xl font-bold text-white">Peki, Kimiz Biz ?</h1>-->
            <h1 class="text-2xl font-bold text-white">So Who Are We ?</h1>
        </div>
        <div class="w-full h-full px-3 md:px-10 tex-sm md:text-md text-gray-900 pb-5">
            <!--<p class="indent-7 mt-5 mb-3">
                <span class="font-bold">Merhaba</span>, Biz hsrcpay™ markası olarak siz değerli müşterilerimize ödeme almanız için aracı oluyoruz.
                Öncelikle Markamız hsrcpay yeni bir kuruluş olmasının yanısıra ödeme almanız için kolaylık sağlar.
                Markamız yenilikçi birkaçı hariç şartsız koşulsuz kullanım hakkı sunmak üzere planlandı.
                Ödeme almayı kolaylaştırmak üzere yürümeye karar veren Markamızın açılış sebebi ise:
            </p>

            <p class="indent-7 mb-3">
                "HSRC-Pay Markası'nın sahibi olarak ortalama 2016-2020, 12-17 yaşlarım arasında dijital ürün satışı yapıyordum.
                Ama 18 yaşımda olmadığım için herhangi bir sanal pos kullanamıyordum ve yüzlerce lira kaybettim.
                Şuan 18 yaş şartı koşmadan bütün bireylerin ödeme alabilmesi için bu markayı oluşturdum."
            </p>

            <p class="indent-7 mb-3">
                <strong>Mustafa HASIRCIOĞLU</strong> tarafından geliştirilen bu proje beta aşamasında olup kullanıma açılmıştır.
                En büyük özelliklerinden birisi tam otomasyon bir sistem olmasıdır. Eklediğiniz websitesi'nin onaylanma süreci 5 dakikadır.
                Tek yapmanız gereken websitenizin ana dizinine "hsrcpay-ownercheck.txt" adlı bir dosya oluşturmak.
                Ardından dosyanın içine kayolurken kullandığınız mail adresini boşluksuz olarak yazmak.
                Ortalama birkaç dakika içinde tarafınıza onay maili iletilecek ardından ödeme almaya başlayabilirsiniz.
            </p>

            <p class="indent-7">
                Güvenlik açısından alınan ödemeler, Hafta sonu dahil olmak üzere :) 3 ile 6 gün içerisinde verdiğiniz iban adresine otomasyon tarafından iletilir. (Müşteri tarafında problem oluşmaz ise en fazla 2 gün sonra aktarılır)
                Sizlere verdiğimiz önemi müşterilerinize de veriyoruz herkesin güvenliği bizim için çok önemli!
            </p>-->


            <p class="indent-7 mt-5 mb-3">
                <span class="font-bold">Hello</span>, We, as hsrcpay™ brand, act as an intermediary for you, our valued customers, to receive payment. First of all, our brand hsrcpay, besides being a new organization, provides convenience for you to receive payment. Our brand is planned to offer unconditional usage rights, except for a few innovative ones. The reason for the opening of our Brand, which decided to walk to make it easier to receive payment, is:
            </p>

            <p class="indent-7 mb-3">
                "As the owner of the HSRC-Pay Brand, I was selling digital products between the ages of 12-17, 2016-2020 on average.
                But since I was not 18 years old, I could not use any virtual pos and I lost hundreds of liras.
                I have created this brand so that all individuals can receive payments without the age requirement of 18."
            </p>

            <p class="indent-7 mb-3">
                This project, developed by <strong>Mustafa HASIRCIOĞLU</strong>, is in beta stage and has been put into use.
                One of its biggest features is that it is a fully automated system. The approval process of the website you add is 5 minutes.
                All you have to do is create a file named "hsrcpay-ownercheck.txt" in the home directory of your website.
                Then, write the e-mail address you used while registering into the file, without spaces.
                A confirmation e-mail will be sent to you in a few minutes on average, and then you can start receiving payments.
            </p>

            <p class="indent-7">
                Payments received in terms of security are sent by automation to the iban address you provide within 3 to 6 days, including the weekend. (If there is no problem on the customer's side, it will be transferred after a maximum of 2 days)
                We give the same importance to your customers as we give to you. Everyone's safety is very important to us!
            </p>
        </div>

    </div>

</div>





<div class="p-4 bg-white sm:p-6 dark:bg-gray-900" id="footer-side">
    <div class="md:flex md:justify-between">
        <div class="mb-6 md:mb-0">
            <a href="<?php echo configs_host_ssl . "://" . configs_host_ssl; ?>" class="flex items-center">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">HSRC-Pay</span>
            </a>
        </div>
        <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-4">
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Document</h2>
                <ul class="text-gray-600 dark:text-gray-400">
                    <li class="mb-4">
                        <a href="https://documenter.getpostman.com/view/20063260/VUqoPJHd" target="_blank" class="hover:underline">Api Documentations</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Contact US</h2>
                <ul class="text-gray-600 dark:text-gray-400">
                    <li class="mb-4">
                        <a href="mailto:support@hsrcpay.com" target="_blank"  class="hover:underline">support@hsrcpay.com</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline" target="_blank">+90 555 890 98 99</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                <ul class="text-gray-600 dark:text-gray-400">
                    <li class="mb-4">
                        <a href="https://instagram.com/hsrcpay" target="_blank" class="hover:underline ">Instagram</a>
                    </li>
                    <li class="mb-4">
                        <a href="https://facebook.com/hsrcpay" target="_blank" class="hover:underline ">Facebook</>
                    </li>
                    <li class="mb-4">
                        <a href="https://twitter.com/hsrcpay" target="_blank" class="hover:underline ">Twitter</a>
                    </li>
                    <li>
                        <a href="https://discord.com/hsrcpay" target="_blank" class="hover:underline">Discord</a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                <ul class="text-gray-600 dark:text-gray-400">
                    <li class="mb-4">
                        <a href="/policy?page=privacy" target="_blank"  class="hover:underline">Privacy Policy</a>
                    </li>
                    <li class="mb-4">
                        <a href="/policy?page=use" target="_blank"  class="hover:underline">Terms &amp; Conditions</a>
                    </li>
                    <li>
                        <a href="/policy?page=cookie" target="_blank"  class="hover:underline">Cookie Agreement</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
    <div class="sm:flex sm:items-center sm:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a href="https://hsrcpay.com/" class="hover:underline">HSRC-Pay™</a>. All Rights Reserved.
        </span>
        <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
            <a href="https://facebook.com/hsrcpay" target="_blank"  class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Facebook page</span>
            </a>
            <a href="https://instagram.com/hsrcpay" target="_blank"  class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Instagram page</span>
            </a>
            <a href="https://twitter.com/hsrcpay" target="_blank"  class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                <span class="sr-only">Twitter page</span>
            </a>
            <a href="https://github.com/hsrcpay" target="_blank"  class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">GitHub account</span>
            </a>
            <a href="/" target="_blank"  class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Dribbbel account</span>
            </a>
        </div>
    </div>
</div>
