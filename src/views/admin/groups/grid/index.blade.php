{{-- Groups Grid --}}
<section class="panel panel-default panel-grid">

    {{-- Grid: Header --}}
    <header class="panel-heading">

        <nav class="navbar navbar-default navbar-actions">

            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#groups-actions">
                        <span class="fa fa-bars"></span>
                    </button>
                </div>

                {{-- Grid: Actions --}}
                <div class="collapse navbar-collapse" id="groups-actions">

                    <ul class="nav navbar-nav navbar-left">

                        <li class="dropdown">
                            <a href="#" data-grid-exporter class="dropdown-toggle tip" data-toggle="dropdown" role="button" aria-expanded="false" data-original-title="Export">
                                <i class="fa fa-download"></i> <span class="visible-xs-inline">Export</span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" data-download="pdf" data-toggle="tooltip" data-original-title="Export Results as PDF"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
                                <li><a href="#" data-download="csv" data-toggle="tooltip" data-original-title="Export Results as CSV"><i class="fa fa-file-excel-o"></i> CSV</a></li>
                                <li><a href="#" data-download="json" data-toggle="tooltip" data-original-title="Export Results as JSON"><i class="fa fa-file-code-o"></i> JSON</a></li>
                            </ul>
                        </li>

                        <li class="primary">
                            <a href="{{ route('maintenance.admin.groups.create') }}" data-toggle="tooltip" data-original-title="Create">
                                <i class="fa fa-plus"></i> <span class="visible-xs-inline">Create</span>
                            </a>
                        </li>

                    </ul>

                    {{-- Grid: Filters --}}
                    <form class="navbar-form navbar-right" method="post" accept-charset="utf-8" data-search data-grid="groups" role="form">

                        <div class="input-group">

                            <span class="input-group-btn">

                                <button class="btn btn-default" type="button" disabled>
                                    Filters
                                </button>

                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <ul class="dropdown-menu" role="menu">

                                    <li>
                                        <a data-grid-calendar-preset="day">
                                            <i class="fa fa-calendar"></i> Today
                                        </a>
                                    </li>

                                    <li>
                                        <a data-grid-calendar-preset="week">
                                            <i class="fa fa-calendar"></i> This Week
                                        </a>
                                    </li>

                                    <li>
                                        <a data-grid-calendar-preset="month">
                                            <i class="fa fa-calendar"></i> This Month
                                        </a>
                                    </li>

                                </ul>

                                <button class="btn btn-default hidden-xs" type="button" data-grid-calendar data-range-filter="created_at">
                                    <i class="fa fa-calendar"></i>
                                </button>

                            </span>

                            <input class="form-control" name="filter" type="text" placeholder="Search">

                            <span class="input-group-btn">

                                <button data-toggle="tooltip" data-original-title="Search" class="btn btn-default" type="submit">
                                    <span class="fa fa-search"></span>
                                </button>

                                <button data-toggle="tooltip" data-original-title="Refresh" class="btn btn-default" data-grid="groups" data-reset>
                                    <i class="fa fa-refresh fa-sm"></i>
                                </button>

                            </span>

                        </div>

                    </form>

                </div>

            </div>

        </nav>

    </header>

    {{-- Page header --}}
    <div class="panel-body">

        {{-- Grid: Applied Filters --}}
        <div class="btn-toolbar" role="toolbar" aria-label="data-grid-applied-filters">

            <div id="groups-filters" class="btn-group" data-grid="groups"></div>

        </div>

    </div>

    {{-- Grid: Table --}}
    <div class="table-responsive">

        <table id="groups-results" class="table table-hover" data-source="{{ route('maintenance.api.v1.admin.groups.grid') }}" data-grid="groups">

            <thead>
                <tr>
                   <th class="sortable" data-sort="Name">Name</th>
               </tr>
           </thead>

            <tbody></tbody>

        </table>

    </div>

    <footer class="panel-footer clearfix text-center">

        {{-- Grid: Pagination --}}
        <div id="groups-pagination" data-grid="groups"></div>

    </footer>

    @include('maintenance::admin.groups.grid.templates.no-results')
    @include('maintenance::admin.groups.grid.templates.results')
    @include('maintenance::admin.groups.grid.templates.pagination')
    @include('maintenance::admin.groups.grid.templates.filters')

</section>

<script>

    $(function()
    {
        $.datagrid('groups', '#groups-results', '#groups-pagination', '#groups-filters');
    });

</script>