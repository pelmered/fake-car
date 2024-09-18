<?php

arch()->preset()->laravel();
arch()->preset()->security()->ignoring('parse_str');;

arch()->expect('dd')->not->toBeUsed();
