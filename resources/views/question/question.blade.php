@foreach($questions as $question)
    @if($question->test_id == $test_id)
        <article class="w-full rounded-xl bg-white my-4 p-4 ring ring-indigo-50 sm:p-6 lg:p-8 h-1/2">
            <div class="flex w-full items-start sm:gap-8">
                <div class="w-full">
                    <div class="flex justify-between">
                        <div class="w-8/12 flex mt-4 text-lg sm:text-xl break-all">
                            <p>
                                {{ $question->question }}
                            </p>
                        </div>
                        <div class="flex flex-col justify-start">
                            <a href="{{route('deleteQuestion', $question->id)}}"
                               class="bg-red-700 text-white font-medium hover:bg-red-800 w-24 h-10 rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 ">
                                <button>
                                    Удалить
                                </button>
                            </a>
                            <a href="{{route('updatePageQuestion', $question->id)}}"
                               class="focus:outline-none text-white font-medium bg-blue-500 w-24 h-10 hover:bg-blue-700 rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                                <button>
                                    Изменить
                                </button>
                            </a>

                        </div>
                    </div>
                    @include('answer.answer', ['question_id' => $question->id])
                </div>
            </div>
            <div class="mt-6 rounded flex flex-col self-start text-center">
                <a href="{{route('addAnswer', $question->id)}}"
                   class="relative justify-between inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium hover:bg-blue-700 bg-blue-500 text-white">
                    Добавить ответ к вопросу
                    <svg class="w-6 h-6 ml-4 text-gray-800 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z"/>
                        <path
                            d="M8.139 10.411 5.289 13.3A1 1 0 0 0 5 14v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .7-.288l2.886-2.851-3.447-3.45ZM14 8a2.463 2.463 0 0 0-3.484 0l-.971.983 3.468 3.468.987-.971A2.463 2.463 0 0 0 14 8Z"/>
                    </svg>
                </a>
            </div>
        </article>
    @endif
@endforeach
