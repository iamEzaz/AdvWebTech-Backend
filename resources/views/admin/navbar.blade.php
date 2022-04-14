
@section('navbar')
    <div class="menu">
        <ul>
            <br>
            <p class="h5" style="margin-left: 25px; text-transform: uppercase; font-style: italic;"><i class="flaticon-healthcare" aria-hidden="true" style="padding-right: 15px;"></i>E-Health care</p>
            <br>

            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-desktop" aria-hidden="true" style="padding-right: 15px;"></i><span>Dashboard</span></a></li>

            <li><a href="{{route('user.index')}}"><i class="fa fa-user" aria-hidden="true" style="padding-right: 15px;"></i><span>Add User</span></a></li>

            <li><a href="{{route('user.viewUserList')}}"><i class="fa fa-users" aria-hidden="true" style="padding-right: 15px;"></i><span>View User list</span></a></li>

            <li><a href="{{route('user.manageSalaryIndex')}}"><i class="flaticon-benefit" aria-hidden="true" style="padding-right: 15px;font-size: 1.3rem"></i><span>Manage Salary</span></a></li>

            <li><a href="{{route('user.workSchedulIndex')}}"><i class="flaticon-worker" aria-hidden="true" style="padding-right: 15px;"></i><span>Work Schedule</span></a></li>

            

            <!-- <li><a href=""><i class="flaticon-surgery" aria-hidden="true"  style="padding-right: 15px;"></i><span>Operation Therater</span></a></li> -->

            <li><a href="{{route('user.doctorReview')}}"><i class="
                flaticon-review" aria-hidden="true"  style="padding-right: 15px;"></i><span>View Doctor review</span></a></li>
           
    </div>
@endsection
