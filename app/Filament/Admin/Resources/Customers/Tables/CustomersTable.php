<?php

namespace App\Filament\Admin\Resources\Customers\Tables;

use App\Models\Customer;
use App\Models\Message;
use App\Services\CustomerService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('creator.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->query(function () {
                $service = app(CustomerService::class);

                $customers = $service->getAllCustomers();

                $ids = collect($customers)->pluck('id');

                return Customer::query()
                    ->whereIn('id', $ids)
                    ->with('creator');
            })
            ->filters([
                //
            ])
            ->recordActions([

                //        Action::make('chat')
                // ->label('Chat')
                // ->icon('heroicon-o-chat-bubble-left-right')
                // ->slideOver()
                // ->modalWidth('md')
                // ->modalSubmitAction(false)
                // ->modalCancelAction(false)
                // ->modalContent(fn ($record) => view(
                //     'chats.chat',
                //     [
                //         'customer' => $record,
                //         'messages' => \App\Models\Message::where(function ($q) use ($record) {
                //             $q->where('user_id', auth()->id())
                //               ->where('receiver_id', $record->id);
                //         })
                //         ->orWhere(function ($q) use ($record) {
                //             $q->where('user_id', $record->id)
                //               ->where('receiver_id', auth()->id());
                //         })
                //         ->orderBy('created_at')
                //         ->get(),
                //     ]
                // )),
                // Action::make('chat')
                //     ->label('Chat')
                //     ->icon('heroicon-o-chat-bubble-left-right')
                //     ->slideOver()
                //     ->modalWidth('md')
                //     ->modalHeading('Customer Chat')
                //     ->modalContent(fn ($record) => view(
                //         'chats.chat',
                //         ['customer' => $record]
                //     )),
                //  Action::make('chat')
                // ->label('Chat')
                // ->url(fn ($record) => route('chat', $record->id))
                // ->icon('heroicon-o-chat-bubble-left-right'),

                Action::make('chat')
                    ->label('Chat')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->slideOver()
                    ->modalWidth('md')
                    ->modalHeading('Customer Chat')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->modalContent(fn ($record) => view(
                        'chats.chat',
                        [
                            'customer' => $record,

                            'messages' => Message::where(function ($q) use ($record) {

                                $q->where('user_id', auth()->id())
                                    ->where('receiver_id', $record->user_id);

                            })->orWhere(function ($q) use ($record) {

                                $q->where('user_id', $record->user_id)
                                    ->where('receiver_id', auth()->id());

                            })
                                ->orderBy('created_at')
                                ->get(),
                        ]
                    )),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
