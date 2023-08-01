<?php

namespace app\assignments\view;

enum PAGETYPES
{
    case PAGE_TYPE_NORMAL;
    case PAGE_TYPE_LDP;
    case PAGE_TYPE_ERROR;
    case PAGE_TYPE_DERROR;
}