<x-filament::page>
    <section class="flex flex-col py-8 gap-y-8">
        <div class="flex flex-col gap-8 md:flex-row md:items-start">
            <!-- Left sidebar menu -->
            <div class="flex-col hidden fi-page-sub-navigation-sidebar-ctn w-72 md:flex">
                <ul wire:ignore class="flex flex-col fi-page-sub-navigation-sidebar gap-y-7">
                    <li x-data="{ label: 'sub_navigation_Pages' }" data-group-label="sub_navigation_Pages" class="flex flex-col fi-sidebar-group gap-y-1">
                        <ul class="flex flex-col fi-sidebar-group-items gap-y-1">
                            @foreach($groups as $group)
                                <li class="fi-sidebar-item">
                                    <button
                                        wire:click="selectGroup('{{ $group->group }}')"
                                        class="relative flex items-center justify-center px-2 py-2 transition duration-75 bg-gray-100 rounded-lg outline-none fi-sidebar-item-button gap-x-3 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 dark:bg-white/5"
                                    >
                                        <svg class="w-6 h-6 fi-sidebar-item-icon text-primary-600 dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>

                                        <span class="flex-1 text-sm font-medium truncate fi-sidebar-item-label text-primary-600 dark:text-primary-400">
                                            {{ $group->name }}
                                        </span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Right content area -->
            <div class="grid flex-1 auto-cols-fr gap-y-8">
                @if($activeGroup)
                    <!-- Header dengan tombol Add New Section -->
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                            {{ Str::of($activeGroup)->replace('_', ' ')->headline() }}
                        </h2>

                        {{-- @if(!$showSectionForm)
                            <x-filament::button
                                wire:click="$set('showSectionForm', true)"
                                color="success"
                                size="sm"
                                icon="heroicon-o-plus"
                            >
                                {{ __('Add New Section') }}
                            </x-filament::button>
                        @endif --}}
                    </div>

                    <!-- Form untuk section baru -->
                    @if($showSectionForm)
                        <div class="bg-white shadow-sm fi-section rounded-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                            <div class="p-6 fi-section-content">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                        {{ __('Add New Section') }}
                                    </h3>
                                    <button
                                        wire:click="$set('showSectionForm', false)"
                                        class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300"
                                    >
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <form wire:submit.prevent="addNewSection" class="space-y-4">
                                    <div class="space-y-4">
                                        <!-- Input untuk Nama Section -->
                                        <div class="space-y-2">
                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                                {{ __('Section Name') }} <span class="text-danger-500">*</span>
                                            </label>
                                            <input
                                                type="text"
                                                wire:model="newSectionData.name"
                                                class="w-full border-gray-300 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-800 focus:border-primary-500 focus:ring-primary-500"
                                                required
                                            >
                                        </div>

                                        <!-- Select untuk Tipe Section -->
                                        <div class="space-y-2">
                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                                {{ __('Section Type') }} <span class="text-danger-500">*</span>
                                            </label>
                                            <select
                                                wire:model="newSectionData.type"
                                                class="w-full border-gray-300 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-800 focus:border-primary-500 focus:ring-primary-500"
                                                required
                                            >
                                                <option value="">{{ __('Select type') }}</option>
                                                <option value="text">{{ __('Text Content') }}</option>
                                                <option value="gallery">{{ __('Image Gallery') }}</option>
                                                <option value="features">{{ __('Features List') }}</option>
                                                <option value="custom">{{ __('Custom Fields') }}</option>
                                            </select>
                                        </div>

                                        <!-- Textarea untuk Deskripsi -->
                                        <div class="space-y-2">
                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                                {{ __('Description') }}
                                            </label>
                                            <textarea
                                                wire:model="newSectionData.description"
                                                rows="3"
                                                class="w-full border-gray-300 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-800 focus:border-primary-500 focus:ring-primary-500"
                                            ></textarea>
                                        </div>
                                    </div>

                                    <div class="flex justify-end space-x-3">
                                        <x-filament::button
                                            wire:click="$set('showSectionForm', false)"
                                            color="gray"
                                            size="sm"
                                        >
                                            {{ __('Cancel') }}
                                        </x-filament::button>

                                        <x-filament::button
                                            type="submit"
                                            color="primary"
                                            size="sm"
                                        >
                                            {{ __('Create Section') }}
                                        </x-filament::button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($sections->isNotEmpty())
                        <div class="space-y-6">
                            <form wire:submit.prevent="save" class="grid fi-form gap-y-6">
                                {{ $this->form }}

                                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-800">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ __('Section Type:') }}
                                        <span class="font-medium">
                                            {{ $sections->firstWhere('section', $activeSection)?->type ?? 'default' }}
                                        </span>
                                    </div>

                                    <x-filament::button type="submit" size="md">
                                        {{ __('Save Changes') }}
                                    </x-filament::button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="bg-white shadow-sm fi-section rounded-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                            <div class="p-6 fi-section-content">
                                <div class="flex flex-col items-center justify-center py-12 text-center">
                                    <svg class="w-12 h-12 mb-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('No sections found') }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Create your first section to get started') }}</p>
                                    <div class="mt-4">
                                        <x-filament::button
                                            wire:click="$set('showSectionForm', true)"
                                            color="primary"
                                            size="sm"
                                            icon="heroicon-o-plus"
                                        >
                                            {{ __('Add Section') }}
                                        </x-filament::button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="bg-white shadow-sm fi-section rounded-xl ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                        <div class="p-6 fi-section-content">
                            <div class="flex flex-col items-center justify-center py-12 text-center">
                                <svg class="w-12 h-12 mb-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('No page selected') }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Select a page group from the sidebar to begin editing') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-filament::page>
