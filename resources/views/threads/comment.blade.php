<a href="#" class="text-dark">
    <img class="rounded-circle" :src="'/images/' +  item.user.avatar" width="32" height="32">
</a>
<div class="col-12" style="word-wrap: break-word">
    <strong>
        <u>
            <a href="#" class="text-dark">@{{ item.user.name }}</a>
        </u>


        <div v-if="item.user_id == {{ auth()->user()->id }}">
            {{csrf_field()}}
            <a class="text-dark" href="" v-on:click="setEditComment(item.id, $event)">
                <i class="far fa-edit p-1"></i>
            </a>
            <a v-if="edit_comment == item.id" class="text-dark h5" href="" v-on:click="editComment( item, $event )">
                <i class="fas fa-check"></i>
            </a>
            <a class="text-dark" href="" v-on:click="deleteComment( item.id , $event )">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </strong>

    <div class="border-gray small">
        <p v-if="item.user_id == {{ auth()->user()->id }}">
            <textarea v-if="edit_comment == item.id" class="form-control" name="body_comment"
                      id="" cols="1" rows="1" v-model="item.body">
            </textarea>
        </p>
        <p v-if="edit_comment != item.id">@{{ item.body }}</p>
    </div>

</div>

@{{ countLike(item.like) }}
@if(auth()->check())
    <a v-if="isLike(item.like)" href="" v-on:click="deleteLike( item.id , $event)">
        <i class="fas fa-heart" style="color: red"></i>
    </a>
    <a v-else href="" v-on:click="setLike( item.id , $event)">
        <i class="far fa-heart" style="color: black;"></i>
    </a>
@else
    <p>
        <i class="far fa-heart" style="color: black"></i>
    </p>
@endif