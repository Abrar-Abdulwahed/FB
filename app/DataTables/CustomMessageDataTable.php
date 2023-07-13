<?php

namespace App\DataTables;

use App\Models\CustomMessage;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomMessageDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action',  function ($item) {
            $button = '<form class="enable-message-form" action="' . route('admin.custom-message.changeActive', $item->id) . '" method="POST">
            ' . csrf_field() . '
            ' . method_field('PATCH') . '
            <div class="form-group col-12 mr-3 custom-control custom-switch my-4">
                <input type="checkbox" class="custom-control-input" id="is-active-' . $item->id . '" name="is_active"' .
                    ($item->disactivable() === false ? ' disabled' : '') .
                    ($item->is_active == 1 ? ' checked' : '') .
                '>
                <label class="custom-control-label" for="is-active-' . $item->id .'"></label>
            </div>
        </form>';
            $button .= '<div class="btn-group btn-group-sm">';
            $button .= '<a href="'.route('admin.custom-message.edit', $item->id).'" class="mx-1 btn btn-success"><i class="fas fa-edit"></i></a>';
            $button .= '<button type="button" class="mx-1 btn btn-danger btn-sm" data-toggle="modal" data-target="#confirm-delete-'.$item->id.'">';
            $button .= '<i class="fas fa-trash"></i>';
            $button .= '</button>';
            $button .= '<div class="modal fade" id="confirm-delete-'.$item->id.'">';
            $button .= '<div class="modal-dialog">';
            $button .= '<div class="modal-content">';
            $button .= '<div class="modal-header">';
            $button .= '<p class="modal-title">تأكيد الحذف</p>';
            $button .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $button .= '<span aria-hidden="true">&times;</span>';
            $button .= '</button>';
            $button .= '</div>';
            $button .= '<div class="modal-body text-left">';
            $button .= '<p>هل أنت متأكد من حذف هذا العنصر حذف نهائي؟</p>';
            $button .= '</div>';
            $button .= '<div class="modal-footer justify-content-between">';
            $button .= '<button type="button" class="btn btn-default btn-md" data-dismiss="modal">إغلاق</button>';
            $button .= '<form action="'.route('admin.custom-message.destroy', $item->id).'" method="POST">';
            $button .= csrf_field();
            $button .= method_field('DELETE');
            $button .= '<button type="submit" class="btn btn-dark btn-md">نعم</button>';
            $button .= '</form>';
            $button .= '</div>';
            $button .= '</div>';
            $button .= '</div>';
            $button .= '</div>';
            $button .= '</div>';
            return $button;
        })
        ->setRowId('id');
    }
 
    public function query(CustomMessage $model): QueryBuilder
    {
        return $model->newQuery();
    }
 
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('custom-message-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
    }
 
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('code'),
            Column::make('subject'),
            Column::make('language'),
            Column::make('message_email'),
            Column::make('message_sms'),
            // Column::make('is_active'),
            Column::make('action'),
        ];
    }
 
    // protected function filename(): string
    // {
    //     return 'CustomMessage_'.date('YmdHis');
    // }
}
