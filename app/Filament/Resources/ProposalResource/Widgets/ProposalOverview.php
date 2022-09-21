<?php

namespace App\Filament\Resources\ProposalResource\Widgets;

use App\Models\Proposal;
use App\Models\ProposalItem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ProposalOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('All quotations', Proposal::all()->count())
                ->description('32k increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->color('success'),
            Card::make('Accepted', Proposal::all()->where('status', 'accepted')->count())
                ->description('7% increase')
                ->descriptionIcon('heroicon-s-trending-down')
                ->color('danger'),
            Card::make('Media Oportunity', function(){
                $proposals = Proposal::all()->pluck('id');
                $allProposalItems = ProposalItem::whereIn('proposal_id', $proposals)->pluck('price');
                return number_format($allProposalItems->sum() / $allProposalItems->count(), '2').' €';
            })
                ->description('New clients last month')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
