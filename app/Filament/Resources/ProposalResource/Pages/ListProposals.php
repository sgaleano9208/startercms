<?php

namespace App\Filament\Resources\ProposalResource\Pages;

use App\Models\Client;
use Filament\Pages\Actions;
use App\Models\ProposalItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ProposalResource;

class ListProposals extends ListRecords
{
    protected static string $resource = ProposalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function donwloadPDF(Model $record)
    {
        $client = Client::find($record->client_id);
        $proposalItems = ProposalItem::where('proposal_id', $record->id)->get();

        $pdf = Pdf::loadView('app.proposal.pdf', ['data' => $record, 'proposalItems' => $proposalItems, 'client' => $client])->output();
        return response()->streamDownload(fn () => print($pdf), 'test.pdf');
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProposalResource\Widgets\ProposalOverview::class,
        ];
    }
}
