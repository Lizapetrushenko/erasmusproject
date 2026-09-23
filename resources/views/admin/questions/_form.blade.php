@php($question = $question ?? null)

<div class="field">
    <label for="question_text">{{ __('Question text') }}</label>
    <input type="text" name="question_text" id="question_text" value="{{ old('question_text', $question->question_text ?? '') }}" required>
</div>

<div class="field">
    <label for="option_a">{{ __('Option A') }}</label>
    <input type="text" name="option_a" id="option_a" value="{{ old('option_a', $question->option_a ?? '') }}" required>
</div>

<div class="field">
    <label for="option_b">{{ __('Option B') }}</label>
    <input type="text" name="option_b" id="option_b" value="{{ old('option_b', $question->option_b ?? '') }}" required>
</div>

<div class="field">
    <label for="option_c">{{ __('Option C') }}</label>
    <input type="text" name="option_c" id="option_c" value="{{ old('option_c', $question->option_c ?? '') }}" required>
</div>

<div class="field">
    <label for="option_d">{{ __('Option D') }}</label>
    <input type="text" name="option_d" id="option_d" value="{{ old('option_d', $question->option_d ?? '') }}" required>
</div>

<div class="field">
    <label for="correct_option">{{ __('Correct option') }}</label>
    <select name="correct_option" id="correct_option" required>
        @foreach (['a', 'b', 'c', 'd'] as $option)
            <option value="{{ $option }}" @selected(old('correct_option', $question->correct_option ?? '') === $option)>{{ strtoupper($option) }}</option>
        @endforeach
    </select>
</div>

<div class="field">
    <label for="category">{{ __('Category') }}</label>
    <input type="text" name="category" id="category" value="{{ old('category', $question->category ?? '') }}" required>
</div>

<div class="field">
    <label for="country">{{ __('Country') }}</label>
    <input type="text" name="country" id="country" value="{{ old('country', $question->country ?? '') }}" required>
</div>

<div class="field">
    <label for="difficulty">{{ __('Difficulty') }}</label>
    <select name="difficulty" id="difficulty" required>
        @foreach (['easy' => __('Easy'), 'medium' => __('Medium'), 'hard' => __('Hard')] as $difficulty => $label)
            <option value="{{ $difficulty }}" @selected(old('difficulty', $question->difficulty ?? '') === $difficulty)>{{ $label }}</option>
        @endforeach
    </select>
</div>

<button type="submit" class="button">{{ __('Save') }}</button>
