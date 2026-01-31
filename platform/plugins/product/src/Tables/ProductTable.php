<?php

namespace Botble\Product\Tables;

use Botble\Product\Models\Product;
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
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;

class ProductTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Product::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('product.create'))
            ->addActions([
                EditAction::make()->route('product.edit'),
                DeleteAction::make()->route('product.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                NameColumn::make('title')->title('Name')->route('product.edit'),
                CreatedAtColumn::make(),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('product.destroy'),
            ])
            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                    'id', 'type_id',
                    'title', 'desc', 'brand_name', 'combination', 'image', 'pack', 'mrp', 'status', 'created_at',
            
                ]);
            });
    }
}
