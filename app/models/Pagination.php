<?php
class Pagination
{
    public function createPageLinks($totalRow, $parPage, $page)
    {
        $preDisabled = $page == 1 ? 'disabled' : '';
        $nextDisabled = $page > ($totalRow / $parPage) ? 'disabled' : '';
        #pre
        $output = '<li class="page-item ' . $preDisabled . '">
            <a class="page-link" href="./?page=' . ($page - 1) . '" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>';
        #page
        for ($i = 1; $i < ($totalRow / $parPage) + 1; $i++) {
            if ($i == $page) {
                $output .= ' <li class="page-item active"><a class="page-link" href="./?page=' . ($i) . '">' . $i . '</a></li>';
            } else {
                $output .= ' <li class="page-item"><a class="page-link" href="./?page=' . ($i) . '">' . $i . '</a></li>';
            }
        }
        #next
        $output .= '<li class="page-item ' . $nextDisabled . '">
            <a class="page-link" href="./?page=' . ($page + 1) . '" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>';
        return $output;
    }
}
                                                                                                                   