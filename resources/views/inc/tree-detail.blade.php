<div class="modal fade" id="TreeDetail{{ $user }}" tabindex="-1"
    aria-labelledby="TreeDetail{{ $user }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody class="text-start">
                        <tr>
                            <td>Username: </td>
                            <td class="text-end">{{ DB::table('users')->find($user)->fname }}
                                {{ DB::table('users')->find($user)->lname }}</td>
                        </tr>
                        <tr>
                            <td>Active Investment</td>
                            <td class="text-end">${{ number_format(getActivePlan($user), 2) }}</td>
                        </tr>
                        <tr>
                            <td>Sponser Username</td>
                            <td class="text-end">{{ DB::table('users')->find($user)->refer }}
                                ({{ DB::table('users')->find($user)->position }})</td>
                        </tr>
                        <tr>
                            <td>Total Left Paid Team</td>
                            <td class="text-end">{{ leftReferrals($user) }}</td>
                        </tr>
                        <tr>
                            <td>Total Right Paid Team</td>
                            <td class="text-end">{{ rightReferrals($user) }}</td>
                        </tr>
                        <tr>
                            <td>Total Left Sale</td>
                            <td class="text-end">${{ number_format(BusinessVolume($user, 'left'), 2) }}</td>
                        </tr>
                        <tr>
                            <td>Total Right Sale</td>
                            <td class="text-end">${{ number_format(BusinessVolume($user, 'right'), 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
