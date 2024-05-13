<div>
    <h2>Management</h2>

    <!-- Create Form -->
    <form wire:submit.prevent="create">
        {{-- @foreach ($fields as $field)
            <div>
                <label>{{ $field['label'] }}</label>
                @if ($field['type'] === 'text')
                    <input type="text" wire:model.lazy="dynamicProperties.{{ $field['name'] }}" />
                    @error('dynamicProperties.' . $field['name'])
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                @elseif($field['type'] === 'email')
                    <input type="email" wire:model.lazy="dynamicProperties.{{ $field['name'] }}" />
                    @error('dynamicProperties.' . $field['name'])
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                @elseif($field['type'] === 'password')
                    <input type="password" wire:model.lazy="dynamicProperties.{{ $field['name'] }}" />
                    @error('dynamicProperties.' . $field['name'])
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                @endif
            </div>
        @endforeach

        <button type="submit">Create</button>
    </form> --}}

        <!-- Data Table -->
        {{-- <table>
        <thead>
            <tr>
                @foreach ($fields as $field)
                    <th>{{ $field['label'] }}</th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->read() as $item)
                <tr>
                    @foreach ($fields as $field)
                        <td>{{ $item->{$field['name']} }}</td>
                    @endforeach
                    <td>
                        <button wire:click="edit({{ $item->id }})">Edit</button>
                        <button wire:click="delete({{ $item->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
</div>
