<?php

namespace Botble\Category\Tables;

use Botble\Category\Models\Category;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\ImageColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;

class CategoryTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Category::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('category.create'))
            ->addActions([
                EditAction::make()->route('category.edit'),
                DeleteAction::make()->route('category.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                // NameColumn::make()->route('category.edit'),

                Column::make('title')->route('category.edit'),
                Column::make('desc')->title('Description'),
                Column::make('short_desc')->title('Short Description'),
                ImageColumn::make('image')
                    ->title('Image'),
            
                StatusColumn::make(),
                    CreatedAtColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('category.destroy'),
            ])
            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                    'id', 
                    'title', 'desc', 'short_desc', 'image',
        
                    'created_at',
                    'status',
                ]);
            });
    }
}
