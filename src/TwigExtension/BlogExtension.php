<?php

namespace App\TwigExtension;



use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class BlogExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('created_ago', [$this, 'createdAgo'])
        ];
    }

    public function createdAgo(\DateTime $dateTime)
    {
        $delta = time() - $dateTime->getTimestamp();

        if ($delta < 0 ) {
            throw new \InvalidArgumentException('createdAgo is unable to handle dates in the future');
        }

        $duration = '';

        switch ($delta) {
            case ($delta < 60):
                $duration = $delta.' second'.($delta > 1 ? 's' : '').' ago';
                break;
            case ($delta <= 3600):
                $time = floor($delta / 60);
                $diration = $time.' minute'.($time > 1 ? 's' : '').' ago';
                break;
            case ($delta < 86400):
                $time = floor($delta / 3600);
                $diration = $time.' hour'.($time > 1 ? 's' : '').' ago';
                break;
            default:
                $time = floor($delta / 86400);
                $diration = $time.' day'.($time > 1 ? 's' : '').' ago';
                break;
        }

        return $duration;
    }
}