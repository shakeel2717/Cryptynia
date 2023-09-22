<?php

namespace App\Http\Controllers;

use App\Models\TeamReward;
use Illuminate\Http\Request;

class TeamRewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rewards = TeamReward::get();
        return view('user.team_ranks.index',compact('rewards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamReward $teamReward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamReward $teamReward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeamReward $teamReward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamReward $teamReward)
    {
        //
    }
}
