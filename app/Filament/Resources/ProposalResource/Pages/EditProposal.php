<?php

namespace App\Filament\Resources\ProposalResource\Pages;

use App\Models\Client;
use Filament\Pages\Actions;
use App\Models\ProposalItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ProposalResource;
use Filament\Forms\Components\Actions\Modal\Actions\Action;

class EditProposal extends EditRecord
{

    protected static string $resource = ProposalResource::class;


    public function donwloadPDF()
    {
        $client = Client::find($this->record->client_id);
        $proposalItems = ProposalItem::where('proposal_id', $this->record->id)->get();

        $pdf = Pdf::loadView('app.proposal.pdf', ['data' => $this->record, 'proposalItems' => $proposalItems, 'client' => $client])->output();
        return response()->streamDownload(fn () => print($pdf), 'test.pdf');
    }


    protected function getActions(): array
    {
        return [
            Actions\Action::make('pdf')
            ->action('donwloadPDF')
            ->label('Download pdf')
            ->Button()
            ->openUrlInNewTab()
            ->color('primary')
            ->tooltip('Donwload PDF')
            ->icon('heroicon-s-document'),
        ];
    }

}
