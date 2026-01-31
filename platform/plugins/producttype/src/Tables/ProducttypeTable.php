<?php

namespace Botble\ProductType\Tables;

use Botble\ProductType\Models\Producttype;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\ImageColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;

class ProducttypeTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Producttype::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('producttype.create'))
            ->addActions([
                EditAction::make()->route('producttype.edit'),
                DeleteAction::make()->route('producttype.destroy'),
            ])
            ->addColumns([  
                IdColumn::make(),
                NameColumn::make('title')->route('producttype.edit'),
                Column::make('desc')->title('Description'),
                Column::make('short_desc')->title('Short Description'),
                ImageColumn::make('image')
                    ->title('Image'),
                CreatedAtColumn::make(),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('producttype.destroy'),
            ])
            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                    'id',
                    'title',
                    'desc', 'short_desc', 'image',
                    'created_at',
                    'status',
                ]);
            });
    }
}
