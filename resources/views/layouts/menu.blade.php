<li>
    <a href="{{ route('approve-activities.index') }}">
        <span class="text animated bounce">{{__('messages.register_payment')}}</span>
    </a>
</li>
<li class="{{ Request::is('dashboard/resume') ? 'active' : '' }}">
    <a href="{!! route('dashboard.resume') !!}"><i class="fa fa-desktop"></i>
        <span>{{__('messages.dashboard')}}</span>
    </a>
</li>
@can('advanced')
<li class="{{ Request::is('dashboard/summary') ? 'active' : '' }}">
    <a href="{!! route('dashboard.summary') !!}"><i class="fa fa-bar-chart"></i>
        <span>{{__('messages.monthly_summary')}}</span>
    </a>
</li>
@endcan

@can('advancedActions')
<li class="treeview {{ Request::is('dashboard*') ? 'active' : '' }}" style="height: auto;">
    <a href="#">
        <i class="fa fa-share"></i> <span>{{__('messages.information')}}</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu" style="display: none;">
        <li>
            <a href="{!! route('dashboard.payment') !!}"><i class="fa fa-balance-scale"></i>
                {{__('messages.payments')}}
            </a>
        </li>
        <li>
            <a href="{!! route('dashboard.pending_users') !!}"><i class="fa fa-group"></i>
                {{__('messages.users_pendings')}}
            </a>
        </li>
    </ul>
</li>
@endcan

<li class="treeview {{ Request::is('loans*') ? 'active' : '' }}" style="height: auto;">
    <a href="#">
        <i class="fa fa-credit-card"></i> <span>{{__('messages.loans')}}</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu" style="display: none;">
        <li class="{{ Request::is('loans*') ? 'active' : '' }}">
            <a href="{!! route('loans.index') !!}"><i class="fa fa-credit-card"></i>
                <span>{{__('messages.active_loans')}}</span>
            </a>
        </li>
        <li class="{{ Request::is('loans/history') ? 'active' : '' }}">
            <a href="{!! route('loans.history') !!}"><i class="fa fa-credit-card"></i>
                <span>{{__('messages.historial')}} </span>
            </a>
        </li>
    </ul>
</li>

<li class="{{ Request::is('activities*') ? 'active' : '' }}">
    <a href="{!! route('activities.index') !!}"><i class="fa fa-tasks"></i>
        <span>{{__('messages.payments_history')}}</span>
    </a>
</li>

<li class="{{ Request::is('calculator*') ? 'active' : '' }}">
    <a href="{!! route('calculator.index') !!}"><i class="fa fa-calculator"></i>
        <span>{{__('messages.payment_calculator')}}</span>
    </a>
</li>

@can('advancedActions')

<li class="{{ Request::is('companies*') ? 'active' : '' }}">
    <a href="{!! route('companies.index') !!}"><i class="fa fa-bank"></i>
        <span>{{__('messages.companies')}}</span>
    </a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-user-circle"></i>
        <span>{{__('messages.users')}}</span>
    </a>
</li>

<li class="{{ Request::is('deposits*') ? 'active' : '' }}">
    <a href="{!! route('deposits.index') !!}"><i class="fa fa-money"></i>
        <span>{{__('messages.deposits')}}</span>
    </a>
</li>

<li class="{{ Request::is('withdrawals*') ? 'active' : '' }}">
    <a href="{!! route('withdrawals.index') !!}"><i class="fa fa-edit"></i>
        <span>{{__('messages.withdraws')}}</span>
    </a>
</li>


<li class="{{ Request::is('activityTypes*') ? 'active' : '' }}">
    <a href="{!! route('activityTypes.index') !!}"><i class="fa fa-file"></i>
        <span>{{__('messages.activity_types')}}</span>
    </a>
</li>

@endcan