@if(!$user->trashed())

<div class="modal fade" id="deactivate-user{{ $user->id }}" >
    <div class="modal-dialog">
        <div class="modal-content border-danger">
             <div class="modal-header border-danger">
                <h3 class="h4 text-danger modal-title"><i class="fa-solid fa-user-slash"></i> Deactivate User</h3>
             </div>
            <div class="modal-body text-dark">
                <p>
                Are you sure you want to deactivate
                @if($user->avatar)
                <img serc="{{$user->avatar}}" alt="" class="image-sm rounded-circle">
                @else
                <i class="fa-solid fa-circle-user text-secondary icon-sm align-middle"></i>
                @endif
                <span class="fw-bold">{{ $user->name }}</span>?
                </p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.user.deactivate', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm" database-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">
                         Deactivate
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

        @else
        {{-- user IS deactivated --}}
        {{-- activate --}}
        <div class="modal fade" id="activate-user{{ $user->id }}" >
            <div class="modal-dialog">
                <div class="modal-content border-success">
                    <div class="modal-header border-success">
                        <h3 class="h4 text-success modal-title"><i class="fa-solid fa-user-check"></i> Activate User</h3>
                    </div>
                    <div class="modal-body text-dark">
                        <p>
                        Are you sure you want to activate&nbsp;
                        @if($user->avatar)
                        <img src="{{$user->avatar}}" alt="" class="image-sm rounded-circle">
                        @else
                        <i class="fa-solid fa-circle-user text-secondary icon-sm align-middle"></i>
                        @endif
                        <span class="fw-bold">{{ $user->name }}</span>?
                        </p>
                    </div>
                    <div class="modal-footer border-0">
                        <form action="{{ route('admin.user.activate', $user->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <button type="button" class="btn btn-outline-success btn-sm" database-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">Activate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                    


        @endif

   
