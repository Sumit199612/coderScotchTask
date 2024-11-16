<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function playTournament(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // echo "<pre>"; print_r($data);die;
            // Validation
            $request->validate([
                'name.*' => 'required|string|max:255',
                'email.*' => 'required|email|max:255',
            ]);

            $users = $request->userFields;
            // Check if at least two users are provided
            if (count($users) < 2) {
                return back()->withErrors(['users' => 'At least two users are required to start the tournament.']);
            }
            $groups = [];
            $groupName = 1;

            for ($i = 0; $i < count($users); $i += 2) {
                $group = [
                    'group_name' => 'Group ' . $groupName++,
                    'users' => [],
                ];

                if (isset($users[$i])) {
                    $group['users'][] = $users[$i];
                }
                if (isset($users[$i + 1])) {
                    $group['users'][] = $users[$i + 1];
                }

                $groups[] = $group;
            }

            // echo "<pre>"; print_r($groups);die;

            $firstRoundWinner = [];
            $roundDetails = [];

            foreach ($groups as $group) {
                $randomIndex = array_rand($group['users']);
                $firstRoundWinner[] = $group['users'][$randomIndex];
            }

            if (count($firstRoundWinner) > 1) {
                $roundNumber = 1;
                $winners = $firstRoundWinner;
                $roundMatches = [];

                $roundDetails[] = [
                    'roundNumber' => $roundNumber,
                    'matches' => array_map(function($user) {
                        return ['player1' => $user['name'], 'player2' => 'N/A'];
                    }, $winners),
                    'roundWinners' => array_map(function($winner) {
                        return $winner['name'];
                    }, $winners),
                ];
                

                while (count($winners) > 1) {
                    $roundWinners = [];
                    $roundMatches = [];

                    for ($i = 0; $i < count($winners); $i += 2) {
                        if (isset($winners[$i + 1])) {
                            $roundMatches[] = [
                                'player1' => $winners[$i]['name'],
                                'player2' => $winners[$i + 1]['name'],
                            ];

                            $winner = rand(0, 1) ? $winners[$i] : $winners[$i + 1];
                            $roundWinners[] = $winner;
                        } else {
                            $roundMatches[] = [
                                'player1' => $winners[$i]['name'],
                                'player2' => 'N/A',
                            ];
                            $roundWinners[] = $winners[$i];
                        }
                    }

                    $roundDetails[] = [
                        'roundNumber' => ++$roundNumber,
                        'matches' => $roundMatches,
                        'roundWinners' => array_map(function($winner) {
                            return $winner['name'];
                        }, $roundWinners)
                    ];
                    $winners = $roundWinners;
                }
            }

            $finalWinner = $winners[0];

            // echo "<pre>"; print_r($roundDetails); die;

            return view('tournamentIndex', ['groupDetails' => $groups, 'finalWinner' => $finalWinner, 'roundDetails' => $roundDetails]);
        }
    }
}
