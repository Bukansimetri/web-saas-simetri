<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class SitesPages extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Pages';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Sites';
}
