<?php

namespace Botble\Testimonials\Tables;

use Botble\Testimonials\Models\Testimonials;
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

class TestimonialsTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Testimonials::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('testimonials.create'))
            ->addActions([
                EditAction::make()->route('testimonials.edit'),
                DeleteAction::make()->route('testimonials.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                NameColumn::make()->route('testimonials.edit'),
                CreatedAtColumn::make(),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('testimonials.destroy'),
            ])
            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                    'id',
                    'name',
                    'created_at',
                    'status',
                ]);
            });
    }
}
