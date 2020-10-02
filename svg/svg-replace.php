<?php
                        $svg_file = file_get_contents('http://localhost/atapx/elins/web/app/uploads/2020/09/industries-2.svg');
                        str_replace("world","Peter","Hello world!");
                        $find_string   = '<svg';
                        $position = strpos($svg_file, $find_string);
                        $svg_file_new = substr($svg_file, $position);
                        // $svg_file_new = str_replace('height="1000" width="1000"',"",$svg_file_new);
                        // $svg_file_new = preg_replace('/height="(.*?)"/', 'height="24px"', $svg_file_new);
                        // $svg_file_new = preg_replace('/width="(.*?)"/', 'width="24px"', $svg_file_new);
                        $svg_file_new = preg_replace('/<svg(.*?)>/', '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">', $svg_file_new);

                        $svg_file_new = preg_replace('/<path(.*?)<\/path>/', '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path$1</path></g>', $svg_file_new);


                        echo '<span class="svg-icon svg-icon-primary svg-icon-2x">' . $svg_file_new . '</span>';

                        ?>
