<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class QuestTitleRule implements Rule
{
    protected $data;

    /**
     * Create a new rule instance.
     *
     * @param  int  $reward
     * @return void
     */
    public function __construct($data = null)
    {
        // Get the entire GraphQL request payload
        $query = request()->input('query'); // Get the GraphQL query string
        $variables = request()->input('variables'); // Get the GraphQL variables, if any

        // Parse the data from either variables or query string
        if ($variables) {
            $this->data = $variables; // Use variables if available
        } else {
            // Parse the data from the query string directly
            $this->parseQuery($query);
        }
    }

        /**
     * Parse the query string to extract argument values.
     *
     * @param  string  $query
     * @return void
     */
    protected function parseQuery($query)
    {
        // Regular expression to extract the arguments in the createQuest mutation
        preg_match('/createQuest\(title: "(.*?)", description: "(.*?)", reward: (\d+), category_id: (\d+)/', $query, $matches);
        
        if ($matches) {
            $this->data = [
                'title' => $matches[1],
                'description' => $matches[2],
                'reward' => (int)$matches[3],
                'category_id' => (int)$matches[4]
            ];
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $reward = $this->data['reward'] ?? 0;
        if ($reward >= 1) {
            return $value && strlen($value) >= 5;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The title must be at least 5 characters when the reward is greater than 1.';
    }
}
