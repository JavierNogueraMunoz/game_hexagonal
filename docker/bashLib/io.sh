#!/bin/bash
########################################################################################################################
# Magic Bash operations                                                                                                #
########################################################################################################################
scall() {
    # Save environment
    local _saved_variables=`typeset -px`
    local _random_suffix="${RANDOM_SUFFIX}"
    local bash_lib_dir="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd -P )"

    # This strange command will execute the passed command
    "$@"
    local _process_status=$?

    # Restore environment
    eval "${_saved_variables}"
    source "${bash_lib_dir}/commonVariables.sh"
    RANDOM_SUFFIX="${_random_suffix}"

    return ${_process_status}
}
