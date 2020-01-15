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

        switch (true) {
            case ($delta < 0):
                throw new \InvalidArgumentException('createdAgo is unable to handle dates in the future');
                break;
            case ($delta < 60):
                return $duration = $delta.' second'.($delta == 0 || $delta > 1 ? 's' : '').' ago';
                break;
            case ($delta < 3600):
                $time = floor($delta / 60);
                return $diration = $time.' minute'.($time > 1 ? 's' : '').' ago';
                break;
            case ($delta < 86400):
                $time = floor($delta / 3600);
                return $diration = $time.' hour'.($time > 1 ? 's' : '').' ago';
                break;
            default:
                $time = floor($delta / 86400);
                return $diration = $time.' day'.($time > 1 ? 's' : '').' ago';
                break;
        }
    }
}