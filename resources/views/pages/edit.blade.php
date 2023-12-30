@section('title')
    Edit - {{ $tweet->content }}
@endsection
<x-app-layout>
    <div class="py-6 px-3">
        <form method="POST" action="{{ route('tweet.update', $tweet->id) }}">
            @csrf
            @method('PUT')
            <textarea name="content" id="" rows="10" cols="30" class="w-full rounded-md bg-gray-800 text-white"
                placeholder="Tuliskan postingan...">{{ $tweet->content }}</textarea>
            <button type="submit" value="edit" class="primary-blue px-5 py-2 rounded-full text-white mt-4"
                style="background-color: #4AB6FF">Publish</button>
        </form>
    </div>
</x-app-layout>
