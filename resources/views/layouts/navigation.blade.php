@can('is_admin')
    @include('layouts.navigation.admin')
@endcan

@can('is_prof')
    @include('layouts.navigation.professeur')
@endcan

@can('is_regisseur')
    @include('layouts.navigation.regisseur')
@endcan

@can('is_responsable')
    @include('layouts.navigation.responsable')
@endcan