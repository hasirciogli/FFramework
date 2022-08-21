<?php

if ((isset($_SESSION["FRAMEWORD_ERROR_VIEW_STATUS"]) ? $_SESSION["FRAMEWORD_ERROR_VIEW_STATUS"] : false) == false) {
    header("Location: /");
}

?>

    <div class="flex w-full flex-col h-screen bg-slate-300 fixed z-[105]">
        <div class="w-full h-10 flex items-center p-3 bg-red-600 tex-2xl text-white font-semibold"><?php echo isset($_SESSION["FRAMEWORD_ERROR_VIEW_ERRSTR"]) ? $_SESSION["FRAMEWORD_ERROR_VIEW_ERRSTR"] : " NULL";  ?></div>
        <div class="flex flex-row h-full flex-wrap w-full h-full">
            <div class="flex flex-col items-center text-white font-semibold bg-blue-600 w-3/12">
                <a href="<?php echo isset($_SESSION["FRAMEWORD_ERROR_VIEW_ERRBACKLINK"]) ? $_SESSION["FRAMEWORD_ERROR_VIEW_ERRBACKLINK"] : "/"; ?>" class="w-full flex items-center justify-center h-10 bg-red-800 text-white">GO BACK</a>

                <?php
                echo "Error at line -> " . (isset($_SESSION["FRAMEWORD_ERROR_VIEW_ERRLINE"]) ? $_SESSION["FRAMEWORD_ERROR_VIEW_ERRLINE"] : " NULL");
                ?>

            </div>

            <div class="flex bg-green-600 w-9/12">
            <textarea name="" id="" cols="30" rows="10" class="w-full bg-slate-300 p-3 h-full">
                <?php echo isset($_SESSION["FRAMEWORD_ERROR_VIEW_ERRFILE"]) ? file_get_contents($_SESSION["FRAMEWORD_ERROR_VIEW_ERRFILE"]) : " NULL"; ?>
            </textarea>
            </div>
        </div>
    </div>

<?php

$_SESSION["FRAMEWORD_ERROR_VIEW_STATUS"]        = false;
$_SESSION["FRAMEWORD_ERROR_VIEW_ERRNO"]         = null;
$_SESSION["FRAMEWORD_ERROR_VIEW_ERRSTR"]        = null;
$_SESSION["FRAMEWORD_ERROR_VIEW_ERRFILE"]       = null;
$_SESSION["FRAMEWORD_ERROR_VIEW_ERRLINE"]       = null;
$_SESSION["FRAMEWORD_ERROR_VIEW_ERRCONTEXT"]    = null;
$_SESSION["FRAMEWORD_ERROR_VIEW_ERRBACKLINK"]    = null;

?>