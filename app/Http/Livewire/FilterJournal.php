<?php

namespace App\Http\Livewire;

use Jonassiewertsen\Livewire\WithPagination;
use Livewire\Component;
use Statamic\Facades\Entry;
use Statamic\Facades\Site;

class FilterJournal extends Component
{
    use WithPagination;

    public $tag;

    public $site_handle;

    protected $paginationTheme = 'paginator';

    protected $queryString = [
        'tag',
        'page' => [
            'except' => 1,
            'as' => 'p',
        ],
    ];

    // Set current site language.
    public function mount($site_handle)
    {
        $this->site_handle = $site_handle;
    }

    // Localisation.
    public function hydrate()
    {
        $site = Site::get($this->site_handle);
        setlocale(LC_TIME, $site->locale());
        app()->setLocale($site->shortLocale());
    }

    // Reset pagination.
    public function updating()
    {
        $this->resetPage();
    }

    // Assemble query.
    protected function journal_entries()
    {
        $query = Entry::query()
            ->where('collection', 'journal')
            ->where('status', 'published')
            ->where('locale', $this->site_handle);

        // Filter on tag
        if (! empty($this->tag)) {
            $query->whereTaxonomyIn(["tags::{$this->tag}"]);
        }

        $journal_entries = $query
            ->orderBy('date', 'desc')
            ->paginate(10);

        return $this->withPagination('journal_entries', $journal_entries);
    }

    public function render()
    {
        return view('livewire.filter_journal', $this->journal_entries());
    }
}
